<template>
    <default-input
        :id="id"
        :label="label"
        :errors="errors"
        :notes="notes"
        :clickedShow="clickedShow"
        :show="show"
        :isPassword="true"
    >
        <input
            :type="show ? 'text' : 'password'"
            :name="name"
            :id="id"
            class="form-input"
            :class="[bottomBorder ? 'form-input-b' : 'form-input-full']"
            :placeholder="placeholder"
            :autofocus="autofocus"
            :required="required"
            :value="value"
            @input="$emit('input', $event.target.value)"
        />
    </default-input>
</template>

<script>
import Input from "../../mixins/Input";
export default {
    mixins: [Input],
    data() {
        return {
            show: false
        };
    },
    methods: {
        clickedShow() {
            this.show = !this.show;
        }
    }
};
</script>
