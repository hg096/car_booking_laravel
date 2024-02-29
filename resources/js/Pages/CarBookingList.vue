<script setup>

import PageNation from "@/Components/BaseComp/PageNation.vue";
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { carBrandsKo, carTypesKo } from "@/Components/Datas/CarsData.vue";
import { ref } from "vue";


const props = defineProps({
    cars: {
        type: Object,
    },
    bookingDates: {
        type: Object,
    },
});

</script>

<template>
    <AuthenticatedLayout>
        <Head title="list" />

        <div class="relative mx-4">

            <div v-if="props.bookingDates?.data">
                <h1
                    class="p-5 bg-blue-950 text-white rounded-md my-4 shadow-md font-semibold"
                >
                    내가 예약한 차량 리스트
                </h1>
                <div class="bg-white p-3 w-full rounded mb-10">
                    <div
                        class="bg-gray-100 p-3 w-full rounded my-2 items-center shadow-xl"
                        v-for="bookingDate in props.bookingDates.data"
                        :key="bookingDate.id"
                    >
                        <p class="w-full text-left my-2 font-semibold">
                            차량정보
                        </p>
                        <p class="w-full text-left my-2">
                            {{ bookingDate.name }} - {{ carBrandsKo[bookingDate.brand] }} -
                            {{ carTypesKo[bookingDate.car_size] }}
                        </p>
                        <hr />
                        <p class="w-full text-left my-2 font-semibold">
                            예약정보
                        </p>
                        <p class="w-full text-left my-2 text-[12px]">
                            예약시간: {{ bookingDate.start_date }} ~
                            {{ bookingDate.end_date }}
                            <br />
                            전화번호: {{ bookingDate.phone_num }}
                            <br />
                            이메일: {{ bookingDate.user_email }}
                        </p>
                    </div>
                    <!-- 페이지네이션 -->
                    <PageNation :pageData="props.bookingDates"></PageNation>
                </div>
            </div>

            <h1 class="p-5 bg-gray-200 rounded-md my-4 shadow-md font-semibold">
                등록된 차량 리스트
            </h1>
            <div v-if="props.cars?.data" class="bg-white p-3 w-full rounded">
                <div
                    class="bg-gray-100 p-3 w-full rounded my-2 flex items-center shadow-xl"
                    v-for="car in props.cars.data"
                    :key="car.id"
                >
                    <p class="w-full text-left">
                        {{ car.name }} - {{ carBrandsKo[car.brand] }} - {{ carTypesKo[car.car_size] }}
                    </p>
                    <Link
                        :href="`/show/${car.id}`"
                        class="bg-blue-900 text-white p-2 rounded w-[20%] text-center whitespace-nowrap text-[10px]"
                    >
                        상세보기
                    </Link>
                </div>
                <!-- 페이지네이션 -->
                <PageNation :pageData="props.cars"></PageNation>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style></style>
