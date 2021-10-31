<template>
    <div 
        class="mx-2 p-2 shadow rounded"
        :class="{'w-2/5 md:w-2/6 bg-gradient-to-b from-green-300 to-blue-600': showDetail, 
            'w-2/6 md:w-1/4 bg-green-400': ! showDetail}"
    >
        <div 
            class="p-1 bg-green-800 text-white rounded-sm"
        >
            <div class="text-center text-sm font-black">{{action}}</div>
            <div 
                class="text-xs" 
                :class="{'overflow-ellipsis overflow-x-hidden whitespace-nowrap': ! showDetail}"
                title="description"
            >{{description}}</div>
        </div>
        <div 
            class="cursor-pointer hover:underline overflow-ellipsis text-blue-900 text-sm text-right p-1 mb-2.5" 
            @click="showDetail = !showDetail"
            v-if="computedHasDetail"
        >{{showDetail ? 'hide' : `show`}}</div>
        <div class="text-gray-200 text-sm" v-if="showDetail">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            action: {
                type: String,
                default: ''
            },
            description: {
                type: String,
                default: ''
            },
        },
        data() {
            return {
                showDetail: false
            }
        },
        computed: {
            computedHasDetail() {
                return !! this.$slots.default
            },
            computedDetail() {
                return this.computedHasDetail ? this.$slots.default[0].text : ''
            },
        },
        methods: {
            clickedAction() {
                this.$emit('click', )
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>