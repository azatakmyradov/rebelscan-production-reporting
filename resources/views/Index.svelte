<script lang="ts">
    // @ts-ignore
    import { useForm } from '@inertiajs/svelte';
    import Card from '@/Components/Card.svelte';
    import Cards from '@/Components/Cards.svelte';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.svelte';
    import SelectInput from '@/Components/SelectInput.svelte';
    import axios from 'axios';
    import { route } from '@/helpers';
    import { isPageLoading } from '@/stores/globalStore';
    import toast from 'svelte-french-toast';
    import workOrderLineSchema from './schema/workOrderLine.schema';
    import { z } from 'zod';
    import ListItem from '@/Components/ListItem.svelte';
    import { tick } from 'svelte';
    import ScannerInput from '@/Components/ScannerInput.svelte';
    import PrimaryButton from '@/Components/PrimaryButton.svelte';
    import validate from '@/validate';

    const name = 'Production Reporting';

    export let work_orders: {
        MFGNUM: string;
    }[];

    let lines: z.infer<typeof workOrderLineSchema>[] = [];
    let current_line: z.infer<typeof workOrderLineSchema> | null = null;
    let quantity_verified: boolean = false;
    let ready_to_submit: boolean = false;

    const form = useForm({
        MFGNUM: '',
        UOM: '',
        QTY: '',
        MVTDES: '',
        ITMREF: '',
        LOT: '',
        SLO: '',
        SERNUM: '',
        PALNUM: '',
    });

    function selectWorkOrder(e: Event): void {
        if (!(e.target instanceof HTMLSelectElement)) {
            return;
        }

        $form.reset();
        quantity_verified = false;

        $isPageLoading = true;

        axios
            .get(route('work-orders.show', e.target.value))
            .then((response) => {
                $isPageLoading = false;

                const validation = workOrderLineSchema
                    .array()
                    .safeParse(response.data.lines);

                if (!validation.success) {
                    console.error(validation);
                    toast.error('Failed to load work order');
                    return;
                }

                lines = validation.data;

                if (lines.length === 0) {
                    toast.error('No lines found');
                    return;
                }

                if (lines.length === 1) {
                    current_line = lines[0] ?? null;

                    tick().then(() => {
                        focusOnQuantity();
                    });
                }
            })
            .catch(() => {
                toast.error('Failed to load work order');
                $isPageLoading = false;
            });
    }

    function submit() {
        $form.post(route('production-reporting.store'), {
            preserveScroll: true,
            onSuccess: () => {
                resetForm();
            },
            onError: () => {
                toast.error('Failed to report production');
            },
        });
    }

    function resetForm() {
        $form.reset();
        if (lines.length === 1) {
            current_line = null;
            lines = [];
        }
        quantity_verified = false;
        ready_to_submit = false;
    }

    $: {
        if (current_line) {
            $form.MFGNUM = current_line.MFGNUM;
            $form.ITMREF = current_line.ITMREF;
            $form.UOM = current_line.STU;
        }
    }

    let focusOnQuantity: () => void;
</script>

<svelte:head>
    <title>
        {name}
    </title>
</svelte:head>

<AuthenticatedLayout>
    <svelte:fragment slot="title">
        {name}
    </svelte:fragment>

    <Cards>
        <Card>
            {#if current_line}
                <ListItem name="Line:" is_green>
                    {current_line.MFGLIN}
                </ListItem>
                <ListItem name="Product:" is_green>
                    {current_line.ITMREF}
                </ListItem>
                <ListItem
                    name="Completed:"
                    is_green={parseInt(current_line.EXTQTY) === 0}>
                    {current_line.CPLQTY}
                </ListItem>
                <ListItem
                    name="Remaining:"
                    is_green={parseInt(current_line.EXTQTY) === 0}>
                    {current_line.EXTQTY}
                </ListItem>
            {/if}

            {#if work_orders.length > 0}
                <SelectInput
                    name="Work order"
                    on:change={selectWorkOrder}
                    bind:inputValue={$form.MFGNUM}>
                    {#each work_orders as work_order}
                        <option>{work_order.MFGNUM}</option>
                    {/each}
                </SelectInput>
            {:else}
                <p class="text-center">No work orders found</p>
            {/if}

            {#if lines.length > 1}
                <SelectInput
                    name="Line"
                    on:change={(e) => {
                        if (!(e.target instanceof HTMLSelectElement)) {
                            return;
                        }

                        const line_number = e.target.value;

                        current_line =
                            lines.find((line) => line.MFGLIN === line_number) ??
                            null;

                        if (!current_line) {
                            return;
                        }

                        tick().then(() => {
                            focusOnQuantity();
                        });
                    }}>
                    {#each lines as line}
                        <option value={line.MFGLIN}
                            >{line.MFGLIN} - {line.ITMREF}</option>
                    {/each}
                </SelectInput>
            {/if}

            {#if current_line}
                <ScannerInput
                    bind:inputValue={$form.QTY}
                    bind:setFocus={focusOnQuantity}
                    name="Quantity"
                    validate={validate.quantity.min(1)}
                    on:scanner={() => {
                        quantity_verified = true;

                        if (current_line && current_line.LOT) {
                            $form.LOT = current_line.LOT;
                            ready_to_submit = true;
                        }
                    }} />
            {/if}

            {#if $form.QTY && current_line && !current_line.LOT && quantity_verified}
                <ScannerInput
                    bind:inputValue={$form.LOT}
                    name="Lot"
                    validate={validate.lot_number.min(1)}
                    on:scanner={() => (ready_to_submit = true)} />
            {/if}

            {#if ready_to_submit}
                <PrimaryButton name="Submit" on:click={submit} />
            {/if}
        </Card>
    </Cards>
</AuthenticatedLayout>
