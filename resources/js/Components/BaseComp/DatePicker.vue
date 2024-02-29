<script setup>
import { ref, reactive, onMounted } from "vue";

const state = reactive({
    selectedDate: null,
    isDatepickerVisible: false,
    currentMonth: new Date(),
    monthKo: null,
    days: ["일", "월", "화", "수", "목", "금", "토"],
});

const calendar = ref([]);

const props = defineProps({
    id: {
        default: null,
    },
});

const model = defineModel({
    type: String,
    required: true,
});


onMounted(() => {
    updateCalendar();
});

function updateCalendar() {
    const now = new Date();
    const options = { year: "numeric", month: "long" };
    const formattedDate = state.currentMonth.toLocaleString("ko-KR", options);
    state.monthKo = formattedDate;

    const firstDayOfMonth = new Date(
        state.currentMonth.getFullYear(),
        state.currentMonth.getMonth(),
        1
    );
    const lastDayOfMonth = new Date(
        state.currentMonth.getFullYear(),
        state.currentMonth.getMonth() + 1,
        0
    );
    const firstDayOfWeek = firstDayOfMonth.getDay();
    const lastDayOfWeek = lastDayOfMonth.getDay();
    const daysInMonth = lastDayOfMonth.getDate();

    const newCalendar = [];
    let currentWeek = [];

    for (let i = 0; i < firstDayOfWeek; i++) {
        currentWeek.push(null);
    }

    for (let day = 1; day <= daysInMonth; day++) {
        currentWeek.push({
            date: new Date(
                state.currentMonth.getFullYear(),
                state.currentMonth.getMonth(),
                day
            ),
            day,
        });

        if (currentWeek.length === 7) {
            newCalendar.push([...currentWeek]);
            currentWeek = [];
        }
    }

    for (let i = lastDayOfWeek + 1; i < 7; i++) {
        currentWeek.push(null);
    }

    if (currentWeek.length > 0) {
        newCalendar.push([...currentWeek]);
    }

    calendar.value = newCalendar;
}

function showDatepicker() {
    state.isDatepickerVisible = true;
    document.addEventListener("click", handleOutsideClick);
}

function handleOutsideClick(event) {
    if (!event.target.closest(".datepicker")) {
        state.isDatepickerVisible = false;
        document.removeEventListener("click", handleOutsideClick);
    }
}

function prevMonth() {
    state.currentMonth.setMonth(state.currentMonth.getMonth() - 1);
    updateCalendar();
}

function nextMonth() {
    state.currentMonth.setMonth(state.currentMonth.getMonth() + 1);
    updateCalendar();
}

function selectDate(day) {
    state.selectedDate = formatDate(day.date);
    model.value = state.selectedDate;
    state.isDatepickerVisible = false;
    document.removeEventListener("click", handleOutsideClick);
}

function isWeekend(date) {
    const dayOfWeek = date.getDay();
    return dayOfWeek === 0 || dayOfWeek === 6; // 일요일 또는 토요일인 경우
}

function isSelectedDate(date) {
    return state.selectedDate === formatDate(date);
}

function formatDate(date) {
    const timezoneOffset = date.getTimezoneOffset() * 60000;
    return new Date(date - timezoneOffset).toISOString().split("T")[0];
}
</script>

<template>
    <div class="datepicker relative">
        <input
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
            type="text"
            v-model="model"
            @focus="showDatepicker"
            :id="props.id"

        />
        <div
            v-if="state.isDatepickerVisible"
            ref="datepicker"
            class="datepicker p-4 shadow-2xl rounded-md absolute bg-white w-max"
        >
            <div class="flex justify-between mb-4">
                <button @click="prevMonth" class="font-extrabold">&lt;</button>
                <span class="font-extrabold">{{ state.monthKo }}</span>
                <button @click="nextMonth" class="font-extrabold">&gt;</button>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="grid grid-cols-7 gap-4">
                        <th v-for="day in state.days" :key="day" class="">
                            <p
                                v-if="day == '일'"
                                class="bg-red-300 rounded-sm p-1"
                            >
                                일
                            </p>
                            <p
                                v-else-if="day == '토'"
                                class="bg-blue-300 rounded-sm p-1"
                            >
                                토
                            </p>
                            <p v-else class="bg-gray-200 rounded-sm p-1">
                                {{ day }}
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(week, week_idx) in calendar"
                        :key="week"
                        class="grid grid-cols-7 gap-4 text-center"
                    >
                        <td
                            v-for="(day, day_idx) in week"
                            :key="day_idx"
                            @click="selectDate(day)"
                            class="my-1 cursor-pointer hover:bg-gray-100"
                        >
                            <div v-if="day?.day">
                                <p
                                    v-if="day_idx === 0"
                                    :class="{
                                        'bg-red-300': isWeekend(day.date),
                                        'bg-yellow-200': isSelectedDate(
                                            day.date
                                        ),
                                    }"
                                    class="rounded-sm p-1"
                                >
                                    {{ day.day }}
                                </p>
                                <p
                                    v-else-if="day_idx === 6"
                                    :class="{
                                        'bg-blue-300': isWeekend(day.date),
                                        'bg-yellow-200': isSelectedDate(
                                            day.date
                                        ),
                                    }"
                                    class="rounded-sm p-1"
                                >
                                    {{ day.day }}
                                </p>
                                <p
                                    v-else
                                    :class="{
                                        'bg-yellow-200': isSelectedDate(
                                            day.date
                                        ),
                                    }"
                                    class="rounded-sm p-1"
                                >
                                    {{ day.day }}
                                </p>
                            </div>
                            <div v-else></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped></style>
