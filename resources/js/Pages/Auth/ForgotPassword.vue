<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/BaseComp/InputError.vue';
import InputLabel from '@/Components/BaseComp/InputLabel.vue';
import PrimaryButton from '@/Components/BaseComp/PrimaryButton.vue';
import TextInput from '@/Components/BaseComp/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="mb-4 text-sm text-gray-600">
            비밀번호를 잊어버리셨나요? 문제없습니다. 이메일 주소만 알려주시면 새 비밀번호를 선택할 수 있는 비밀번호 재설정 링크를 이메일로 보내드리겠습니다.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="이메일" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    비밀번호 변경링크 보내기
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
