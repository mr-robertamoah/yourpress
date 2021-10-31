<template>
    <div class="relative w-screen h-screen">
        <div
            class="
                absolute
                left-0
                right-0
                top-0
                bottom-0
                bg-gray-200 bg-opacity-25
            "
        ></div>
        <div class="p-2 w-full md:w-9/12 h-full md:h">
            <div
                class="flex items-center w-full justify-end"
                v-if="buttonType.length"
            ></div>
            <div class="border-green-300 w-full border-b" v-if="heading.length">
                {{ heading }}
            </div>
            <div class="p-2 overflow-y-auto">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        heading: {
            type: String,
            default: "",
        },
        buttonType: {
            type: String,
            default: "",
        },
    },
};
</script>
