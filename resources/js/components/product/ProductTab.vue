<template>
    <div 
        class="border-gray-500 text-sm text-center font-semibold cursor-pointer p-2 w-full
         transform hover:bg-blue-100 transition"
        :class="{
            'border-r-2': border === 'right', 
            'border-l-2': border === 'left',
            'bg-gradient-to-b from-blue-300 to-green-100': computedIsActive,
            'hover:-translate-y-1': !computedIsActive,
        }"
        @click="clicked"
    >
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: {
            border: {
                type: String,
                default: ''
            },
            currentTab: {
                type: String,
                default: ''
            },
            tab: {
                type: String,
                default: ''
            },
        },
        computed: {
            computedIsActive() {
                return this.currentTab === this.$slots.default[0].text || 
                    this.currentTab === this.tab
            }
        },
        methods: {
            clicked() {
                if (this.computedIsActive) {
                    this.$emit('click', '')
                    return
                }
                
                this.$emit('click', this.tab.length ? this.tab : this.$slots.default[0].text)
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>