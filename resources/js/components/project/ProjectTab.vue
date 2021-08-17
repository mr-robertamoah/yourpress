<template>
    <div 
        class="border-gray-500 text-sm text-center font-semibold"
        :class="{'border-r-2': border === 'right', 'border-l-2': border === 'left'}"
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
    }
</script>

<style lang="scss" scoped>

</style>