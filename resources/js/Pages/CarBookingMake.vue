<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/BaseComp/InputError.vue";
import InputLabel from "@/Components/BaseComp/InputLabel.vue";
import PrimaryButton from "@/Components/BaseComp/PrimaryButton.vue";
import TextInput from "@/Components/BaseComp/TextInput.vue";
import { carBrandsKo, carTypesKo, reverseObject } from "@/Components/Datas/CarsData.vue";
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";


const props = defineProps({
    request: {
        type: Object,
    },
});

onMounted(() => {
    if (props.request == undefined) {
        router.visit("/")
    }

    form.carId = props.request.carId;
    form.dateStart = props.request.dateStart;
    form.dateEnd = props.request.dateEnd
});

const form = useForm({
    name: "",
    phoneNum: "",
    userEmail: "",

    carId: null,
    dateStart: "",
    dateEnd: "",
});

const submit = () => {
    form.post(route("cars.booking"), {
        onSuccess: () => {
            form.reset();
        },
        onError: errors => {
            console.error(errors)
        },
    });
};

const carTypes = ref(reverseObject(carBrandsKo));
const carBrands = ref(reverseObject(carTypesKo));


</script>

<template>
    <AuthenticatedLayout>
        <Head title="reservation" />

        <div class="relative mx-4">
            <h1 class="p-5 bg-gray-200 rounded-md my-4 shadow-md font-semibold">차량 예약</h1>
        </div>

        <form @submit.prevent="submit" class="px-4">
            <!-- 이름 -->
            <div class="mt-4">
                <InputLabel for="name" value="이름" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- 연락처 -->
            <div class="mt-4">
                <InputLabel for="phoneNum" value="연락처(-포함)" />
                <TextInput
                    id="phoneNum"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phoneNum"
                    required
                    autofocus
                    autocomplete="phoneNum"
                />
                <InputError class="mt-2" :message="form.errors.phoneNum" />
            </div>

            <!-- 연락처 -->
            <div class="mt-4">
                <InputLabel for="userEmail" value="이메일" />
                <TextInput
                    id="userEmail"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.userEmail"
                    required
                    autofocus
                    autocomplete="userEmail"
                />
                <InputError class="mt-2" :message="form.errors.userEmail" />
            </div>

            <!-- 날짜 -->
            <div class="flex mt-4">
                <div>
                    <p >시작 날짜</p>
                    <p >{{ form.dateStart.replace('T', ' ' ) }}</p>
                </div>
                <p class="text-center flex-center-all w-[20%] pt-[24px]">
                    ~
                </p>
                <div>
                    <p >종료 날짜</p>
                    <p >{{ form.dateEnd.replace('T', ' ' ) }}</p>
                </div>
            </div>

            <!-- 예약완료 -->
            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="min-text ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    예약완료
                </PrimaryButton>
            </div>

        </form>

    </AuthenticatedLayout>
</template>

<style></style>
