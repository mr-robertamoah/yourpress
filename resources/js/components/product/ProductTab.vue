<template>
    <div 
        class="border-gray-500 text-sm text-center font-semibold cursor-pointer p-2 w-full"
        :class="{'border-r-2': border === 'right', 'border-l-2': border === 'left'}"
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
        },
        methods: {
            clicked() {
                this.$emit('click', this.$slots.default[0].text)
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>