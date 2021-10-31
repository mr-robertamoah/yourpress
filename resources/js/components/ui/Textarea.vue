<template>
    <default-input :id="id" :label="label" :errors="errors" :notes="notes">
        <textarea
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
            :cols="cols"
            @input="$emit('input', $event.target.value)"
        ></textarea>
    </default-input>
</template>

<script>
import Input from "../../mixins/Input";
export default {
    mixins: [Input],
    props: {
        cols: {
            type: String,
            default: ""
        }
    }
};
</script>
