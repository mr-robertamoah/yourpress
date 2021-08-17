<template>
    <label :for="htmlFor" class="text-gray-500">
        <slot></slot>
    </label>
</template>

<script>
    export default {
        props: {
            htmlFor: {
                type: String,
                default: ''
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>