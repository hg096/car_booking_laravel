<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/BaseComp/InputError.vue';
import InputLabel from '@/Components/BaseComp/InputLabel.vue';
import PrimaryButton from '@/Components/BaseComp/PrimaryButton.vue';
import TextInput from '@/Components/BaseComp/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <div class="mb-4 text-sm text-gray-600">
            응용프로그램의 보안 영역입니다. 계속하기 전에 비밀번호를 확인하십시오.
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" value="비밀번호" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex justify-end mt-4">
                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    확인
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
