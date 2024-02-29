<script setup>
import InputError from "@/Components/BaseComp/InputError.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";

import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { ko } from "date-fns/locale";

import { carBrandsKo, carTypesKo } from "@/Components/Datas/CarsData.vue";


const props = defineProps({
    car: {
        type: Object,
    },
    carId: {
        type: String,
    },
    bookingDates: {
        type: Object,
    },
});

const isCarShow = ref(false);
const isCarShowMessage = ref("");

//
const dateFormat = ref("");
const dateSt = ref("");
const dateEn = ref("");

const format = (dateFormat) => {
    let startDate = "";
    let endDate = "";

    if (dateFormat[0]) {
        startDate = `${dateFormat[0].getFullYear()}-${
            dateFormat[0].getMonth() + 1
        }-${dateFormat[0].getDate()} ${dateFormat[0].getHours()}:${dateFormat[0].getMinutes()}:00`;
        dateSt.value = startDate;
    } else {
        dateSt.value = "";
        startDate = "";
    }

    if (dateFormat[1]) {
        endDate = `${dateFormat[1].getFullYear()}-${
            dateFormat[1].getMonth() + 1
        }-${dateFormat[1].getDate()} ${dateFormat[1].getHours()}:${dateFormat[1].getMinutes()}:00`;
        dateEn.value = endDate;
    } else {
        dateEn.value = "";
        endDate = "";
    }

    return `${startDate} ~ ${endDate}`;
};
//

const form = useForm({
    dateStart: "",
    dateEnd: "",
    carId: props.carId,
});

watch(
    () => [dateSt.value, dateEn.value],
    async ([newdateSt, newdateEn]) => {

        if (newdateSt && newdateEn) {
            axios
                .post(
                    "/confirm-date",
                    {
                        dateStart: newdateSt,
                        dateEnd: newdateEn,
                        carId: form.carId,
                    },
                    {
                        header: { "Context-Type": "multipart/form-data" },
                    }
                )
                .then((res) => {
                    // 성공했을 경우
                    if (!res.data.isValResult) {
                        isCarShow.value = true;
                        isCarShowMessage.value = "";
                        form.dateStart = newdateSt
                        form.dateEnd = newdateEn

                    } else {
                        isCarShow.value = false;
                        isCarShowMessage.value = "중복되는 날짜가 있습니다";
                    }
                })
                .catch((error) => {
                    // 실패했을 경우
                    console.error(error);
                    isCarShow.value = false;
                    isCarShowMessage.value = "중복되는 날짜가 있습니다";
                });
        } else {
            isCarShow.value = false;
            isCarShowMessage.value = "잘못된 날짜 범위입니다";
        }

    }
);
</script>

<template>
    <AuthenticatedLayout>
        <Head title="show" />

        <div class="relative mx-4">
            <h1 class="p-5 bg-gray-200 rounded-md my-4 shadow-md font-semibold">
                차량 예약 정보 확인
            </h1>

            <p class=" my-4 " >{{ car.name }} - {{ carBrandsKo[car.brand] }} - {{ carTypesKo[car.car_size] }}</p>

            <Datepicker
                v-model="dateFormat"
                :format-locale="ko"
                range
                multi-calendars
                :min-date="new Date()"
                :format="format"
                :clearable="false"
                teleport-center
                select-text="확인"
                cancel-text="닫기"
            />

            <div>
                <InputError class="mt-2" :message="isCarShowMessage" />
            </div>

            <div class="flex my-2">
                <Link
                    v-if="isCarShow"
                    href="/reservation"
                    class="p-2 bg-green-300 rounded-md"
                    method="post"
                    :data="form"
                    as="button"
                    >예약하기</Link>
                <p v-else class="p-2 bg-gray-300 w-fit rounded-md">
                    예약하기
                </p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style></style>
