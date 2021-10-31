<template>
    <default-input :id="id" :label="label" :errors="errors" :notes="notes">
        <input
            type="text"
            :name="name"
            :id="id"
            class="form-input w-full"
            :class="[bottomBorder ? 'form-input-b' : 'form-input-full']"
            :placeholder="placeholder"
            :autofocus="autofocus"
            :required="required"
            :disabled="disabled"
            :value="value"
            @input="$emit('input', $event.target.value)"
        />
    </default-input>
</template>

<script>
import Input from "../../mixins/Input";
export default {
    mixins: [Input],
    props: {
        name: {
            type: String,
            default: ""
        },
        id: {
            type: String,
            default: ""
        },
        label: {
            type: String,
            default: ""
        },
        placeholder: {
            type: String,
            default: ""
        },
        autofocus: {
            type: Boolean,
            default: false
        },
        bottomBorder: {
            type: Boolean,
            default: false
        },
        required: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        },
        value: {
            type: String,
            default: ""
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
    }
};
</script>
