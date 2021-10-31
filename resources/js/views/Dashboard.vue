<template>
    <div class="relative">
        <div 
            class="bg-white flex flex-nowrap items-center mt-10 mx-auto overflow-x-auto p-2 w-11/12"
        >
            <dashboard-action 
                :action="'project'" 
                :description="'create one'"
                @click="clickedAction"
            >sends you to a page where you can create and initialize a project so we can produce a product of your choice</dashboard-action>
            <dashboard-action
                :action="'product'" 
                :description="'create one'"
                @click="clickedAction"
            >sends you to a page where you can create a custom envelope or paper bag</dashboard-action>
        </div>
        <div 
            v-if="! getUser"
            class="w-10/12 mx-auto h-80 my-32 bg-white p-2 rounded shadow">
            <h1>You need to be registered and logged in to fully use this part of the YourPress</h1>
            <main>

            </main>
        </div>

        <dashboard-status></dashboard-status>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import DashboardAction from '../components/dashboard/DashboardAction.vue'
import DashboardStatus from '../components/dashboard/DashboardStatus.vue'
    export default {
        components: {
            DashboardAction,
            DashboardStatus,
        },
        computed: {
            ...mapGetters(['getUser']),
        },
        methods: {
            clickedAction(text) {
                console.log(`text`, text)
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>