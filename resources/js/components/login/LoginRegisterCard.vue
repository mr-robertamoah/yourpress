<template>
    <div class="w-4/5 md:w-1/2">
        <div class="w-full min-h-1/2 shadow-md bg-white h-content px-3 pt-10 rounded pb-1">
            <slot></slot>
        </div>
        <div class="w-full shadow-md bg-white h-content p-2 rounded mt-5">
            <slot name="secondary"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>

</style>