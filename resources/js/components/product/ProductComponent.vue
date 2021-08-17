<template>
    <div>
        <div class="">

        </div>
        <div class="">
            <div class="">

            </div>
            <div class="flex justify-between w-full shadow-md">
                <product-tab
                    @click="clickedProductTab"
                >description</product-tab>
                <product-tab
                    @click="clickedProductTab"
                    border="left"
                >pictures</product-tab>
                <product-tab
                    @click="clickedProductTab"
                    border="left"
                >uses</product-tab>
            </div>
            <div >

            </div>
        </div>
    </div>
</template>

<script>
import ProductTab from './ProductTab.vue'
    export default {
        components: { ProductTab },
        methods: {
            clickedProductTab(tab) {
                console.log(`tab`, tab)
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>