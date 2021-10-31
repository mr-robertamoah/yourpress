<template>
    <div 
        class="border-t-2 border-green-300 fixed z-20 bottom-0 left-0 right-0 py-1 px-2 bg-white flex items-center 
            justify-around flex-nowrap">
        <div class="shadow m-2 flex-shrink-0 max-w-1/4 p-1">
            <h3 class="text-xs font-bold mb-0.5 text-center">status</h3>
            <div class="text-xxs font-medium">this section helps you know what you are currently doing</div>
        </div>
        <div class="w-full text-center text-gray-700 text-sm">
            {{status}}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            status: {
                type: String,
                default: 'no info yet'
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>