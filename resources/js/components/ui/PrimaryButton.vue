<template>
    <button 
        class="appearance-none text-sm cursor-pointer rounded bg-green-100 text-gray-700 p-2"
        :type="type.length ? type :'button'"
    >
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: ''
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>