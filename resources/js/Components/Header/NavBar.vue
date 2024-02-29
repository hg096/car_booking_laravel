<script setup>
import { computed, ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';


const props = defineProps({});

const userAuth = ref(null);

userAuth.value = usePage().props.auth.user || null;


// console.log("userAuth : ", userAuth.value)

</script>

<template>
    <div class="relative pb-[60px] shadow-sm ">
        <div class="absolute top-0 left-0 p-4 flex justify-between w-full ">

            <div>
                <Link href="/" class="mx-1">리스트</Link>
                <Link href="/create"  class="mx-1">차량등록</Link>
            </div>

            <div>
                <!-- 비로그인시 -->
                <div v-if="!userAuth" class="flex">
                    <Link href="/login" class="mx-1">로그인</Link>
                </div>
                <!-- 로그인시 -->
                <div v-else class="flex">
                    <Link  href="/logout" class="mx-1" method="post" as="button">로그아웃</Link>
                </div>
            </div>
        </div>
    </div>
</template>