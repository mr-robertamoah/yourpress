<template>
    <div v-if="product">
        <div
            class="
                h-40
                p-2
                rounded
                shadow
                w-1/2
                mx-auto
                mt-5
                bg-blue-200
                -mb-10
                relative
                z-20
            "
        >
            <h1
                class="
                    h-20
                    w-10/12
                    mx-auto
                    text-center
                    p-1
                    bg-gradient-to-b
                    from-green-300
                    via-green-200
                "
            >
                {{ product.name }}
            </h1>
        </div>
        <div class="relative z-10 shadow border-t-2 border-gray-500 bg-white">
            <div class="h-20"></div>
            <div class="flex justify-between w-full shadow-md">
                <product-tab @click="clickedProductTab" :currentTab="activeTab"
                    >description</product-tab
                >
                <product-tab
                    @click="clickedProductTab"
                    :currentTab="activeTab"
                    border="left"
                    tab="images"
                    >pictures</product-tab
                >
                <product-tab
                    @click="clickedProductTab"
                    :currentTab="activeTab"
                    border="left"
                    >uses</product-tab
                >
            </div>
            <div class="p-2">
                <div
                    class="text-sm text-gray-500"
                    v-if="activeTab === 'description'"
                >
                    {{ computedSelectedItem }}
                </div>
                <div
                    class="flex flex-wrap items-center"
                    v-if="activeTab === 'images'"
                >
                    <img
                        class="
                            min-h-5
                            max-h-20
                            mb-3
                            text-xs text-gray-600
                            object-centerp-1
                            bg-gray-200
                            mx-2
                        "
                        v-for="(image, index) in computedSelectedItem"
                        :src="image.url"
                        alt="an image of the product"
                        :key="index"
                    />
                </div>
                <ul
                    class="px-2 text-sm text-gray-500 list-disc"
                    v-if="activeTab === 'uses'"
                >
                    <li
                        v-for="(use, index) in computedSelectedItem"
                        :key="index"
                        class=""
                    >
                        {{ use }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import ProductTab from "./ProductTab.vue";
import Product from "../../types/Product";
import Image from "../../types/Image";
import { defineComponent, PropType } from "vue";

export default defineComponent({
    components: { ProductTab },
    setup(props) {},
    data() {
        return {
            product: {
                name: "quato",
                type: "envelope",
                size: "4inches X 9inches",
                description:
                    "Anim deserunt et in duis. Officia magna est reprehenderit mollit sit. Qui nulla aute laborum officia adipisicing velit nostrud mollit Lorem sint dolore id. In qui exercitation incididunt et sint id ea magna incididunt nisi magna. Elit occaecat do voluptate laborum ex eu amet consectetur cillum nulla. Tempor excepteur sunt veniam ea laborum irure reprehenderit dolor in ut laboris.",
                uses: [
                    "Proident ipsum in laboris aliquip ipsum reprehenderit adipisicing dolor cillum amet magna aute.",
                    "Ut eu officia anim elit aliqua.",
                    "Culpa veniam esse cupidatat reprehenderit laboris cupidatat irure quis.",
                ],
                images: [
                    { url: "http://127.0.0.1:8090/storage/dummy.png" id: 1, description: ""},
                    { url: "http://127.0.0.1:8090/storage/dummy.png" id: 1, description: ""},
                    { url: "http://127.0.0.1:8090/storage/dummy.png" id: 1, description: ""},
                ] as Image[],
            } as Product,
            activeTab: "description",
        };
    },
    computed: {
        computedSelectedItem() {
            return this.product?.hasOwnProperty(this.activeTab)
                ? this.product[this.activeTab]
                : "nothing to show yet";
        },
    },
    methods: {
        clickedProductTab(tab: string) {
            console.log(`tab`, tab);
            this.activeTab = tab;
        },
    },
});
</script>

<style lang="scss" scoped></style>
