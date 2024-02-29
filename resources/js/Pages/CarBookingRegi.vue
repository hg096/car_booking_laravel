<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/BaseComp/InputError.vue";
import InputLabel from "@/Components/BaseComp/InputLabel.vue";
import PrimaryButton from "@/Components/BaseComp/PrimaryButton.vue";
import SelectBox from "@/Components/BaseComp/SelectBox.vue";
import TextInput from "@/Components/BaseComp/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { carBrandsKo, carTypesKo, reverseObject } from "@/Components/Datas/CarsData.vue";
defineProps({});


const form = useForm({
    name: "",
    brand: "",
    car_size: "",
});

const submit = () => {
    form.post(route("cars.create"), {
        onSuccess: () => { form.reset(); },
    });
};

const carTypes = ref(reverseObject(carBrandsKo));
const carBrands = ref(reverseObject(carTypesKo));

</script>

<template>
    <AuthenticatedLayout>
        <Head title="create" />

        <div class="relative mx-4">
            <h1 class="p-5 bg-gray-200 rounded-md my-4 shadow-md  font-semibold">차량 등록</h1>

            <form @submit.prevent="submit">
                <!-- 차량명 -->
                <div class="mt-4">
                    <InputLabel for="name" value="차량명" />
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

                <!-- 브랜드 -->
                <div class="mt-4">
                    <InputLabel
                        for="brand"
                        value="브랜드"
                    />
                    <SelectBox
                        :options="carBrands"
                        id="brand"
                        v-model="form.brand"
                        required
                        autofocus
                        autocomplete="brand"
                    ></SelectBox>
                    <InputError class="mt-2" :message="form.errors.brand" />
                </div>

                <!-- 차량 크기 -->
                <div class="mt-4">
                    <InputLabel
                        for="car_size"
                        value="차량 크기"
                    />
                    <SelectBox
                        :options="carTypes"
                        id="car_size"
                        v-model="form.car_size"
                        required
                        autofocus
                        autocomplete="car_size"
                    ></SelectBox>
                    <InputError class="mt-2" :message="form.errors.car_size" />
                </div>

                <!-- 등록하기 -->
                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton
                        class="min-text ms-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        등록하기
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<style></style>
