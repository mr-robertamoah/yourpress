<template>
    <div class="mt-1 mb-2 relative">
        <div class="form-controls">
            <form-label :htmlFor="id">{{ label }}</form-label>
            <slot></slot>
        </div>
        <div
            class="absolute top-1 right-1 flex justify-center items-center p-1 cursor-pointer text-xs text-blue-400"
            @click="clickedShow"
            v-if="isPassword"
        >
            <font-awesome-icon
                :icon="['fas', show ? 'eye-slash' : `eye`]"
            ></font-awesome-icon>
        </div>
        <div class="w-full pt-1 px-2" v-if="computedExtraInfo.length">
            <p
                v-for="(info, index) in computedExtraInfo"
                :key="index"
                class="text-left text-xs"
                :class="[errors.length ? 'text-red-400' : 'text-blue-400']"
            >
                {{ info }}
            </p>
        </div>
    </div>
</template>

<script>
import FormLabel from "./FormLabel.vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
export default {
    components: {
        FormLabel,
        FontAwesomeIcon
    },
    props: {
        id: {
            type: String,
            default: ""
        },
        label: {
            type: String,
            default: ""
        },
        isPassword: {
            type: Boolean,
            default: false
        },
        clickedShow: {
            type: Function,
            default() {
                return () => {};
            }
        },
        show: {
            type: Boolean,
            default: false
        },
        notes: {
            type: Array,
            default() {
                return [];
            }
        },
        errors: {
            type: Array,
            default() {
                return [];
            }
        }
    },
    computed: {
        computedExtraInfo() {
            return this.errors.length ? this.errors : this.notes;
        }
    }
};
</script>
