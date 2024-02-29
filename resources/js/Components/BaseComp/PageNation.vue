<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    pageData: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div
        v-if="props.pageData.last_page !== 1"
        class="flex justify-around items-center mt-8"
    >
        <Link
            :href="props.pageData.prev_page_url"
            v-if="props.pageData.prev_page_url"
            class="py-2 px-4 bg-gray-50 rounded hover:bg-white text-center w-fit shadow-sm"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                id="Bold"
                viewBox="0 0 24 24"
                width="20"
                height="20"
            >
                <path
                    d="M17.921,1.505a1.5,1.5,0,0,1-.44,1.06L9.809,10.237a2.5,2.5,0,0,0,0,3.536l7.662,7.662a1.5,1.5,0,0,1-2.121,2.121L7.688,15.9a5.506,5.506,0,0,1,0-7.779L15.36.444a1.5,1.5,0,0,1,2.561,1.061Z"
                />
            </svg>
        </Link>
        <div v-else class="py-2 px-4 bg-gray-300 rounded text-center shadow-sm">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                id="Bold"
                viewBox="0 0 24 24"
                width="20"
                height="20"
            >
                <path
                    d="M17.921,1.505a1.5,1.5,0,0,1-.44,1.06L9.809,10.237a2.5,2.5,0,0,0,0,3.536l7.662,7.662a1.5,1.5,0,0,1-2.121,2.121L7.688,15.9a5.506,5.506,0,0,1,0-7.779L15.36.444a1.5,1.5,0,0,1,2.561,1.061Z"
                />
            </svg>
        </div>

        <span
            v-if="props.pageData.current_page"
            class="text-lg font-bold w-full text-center"
        >
            {{ props.pageData.current_page }}
        </span>

        <Link
            :href="props.pageData.next_page_url"
            v-if="props.pageData.next_page_url"
            class="py-2 px-4 bg-gray-50 rounded hover:bg-white text-center shadow-sm"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                id="Bold"
                viewBox="0 0 24 24"
                width="20"
                height="20"
            >
                <path
                    d="M6.079,22.5a1.5,1.5,0,0,1,.44-1.06l7.672-7.672a2.5,2.5,0,0,0,0-3.536L6.529,2.565A1.5,1.5,0,0,1,8.65.444l7.662,7.661a5.506,5.506,0,0,1,0,7.779L8.64,23.556A1.5,1.5,0,0,1,6.079,22.5Z"
                />
            </svg>
        </Link>
        <div v-else class="py-2 px-4 bg-gray-300 rounded text-center shadow-sm">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                id="Bold"
                viewBox="0 0 24 24"
                width="20"
                height="20"
            >
                <path
                    d="M6.079,22.5a1.5,1.5,0,0,1,.44-1.06l7.672-7.672a2.5,2.5,0,0,0,0-3.536L6.529,2.565A1.5,1.5,0,0,1,8.65.444l7.662,7.661a5.506,5.506,0,0,1,0,7.779L8.64,23.556A1.5,1.5,0,0,1,6.079,22.5Z"
                />
            </svg>
        </div>
    </div>
</template>
