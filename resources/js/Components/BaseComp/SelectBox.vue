<script setup>
import { onMounted, ref } from "vue";

const props = defineProps({
    value: {
      default: null,
    },
    options: {
      type: Object,
    },
});
const model = props.value

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

</script>

<template>
    <select
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
        v-model="model"
        ref="input"

    >
        <option
            v-for="(value, optionOne) in props.options"
            :key="optionOne"
            :value="value"
        >
            {{ optionOne }}
        </option>
    </select>
</template>
