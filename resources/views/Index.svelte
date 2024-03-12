<script lang="ts">
    import Card from "@/Components/Card.svelte";
    import Cards from "@/Components/Cards.svelte";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.svelte";
    import SelectInput from '../../../../resources/js/Components/SelectInput.svelte';

    const name = 'ProductionTracking';

    export let work_orders: {
        O_MFGNUM: string
    }[];
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
            <SelectInput
                name="Work order">
                {#each work_orders as work_order}
                    <option>{work_order.O_MFGNUM}</option>
                {/each}
            </SelectInput>
        </Card>
    </Cards>
</AuthenticatedLayout>
