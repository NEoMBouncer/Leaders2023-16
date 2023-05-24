<template>
  <div class="flex flex-col">
    <h1 class="text-2xl font-semibold pb-5">Кабинет</h1>
    <!--Stepper-->
    <div class="xl:border-b xl:border-t xl:border-gray-200">
      <nav class="mx-auto" aria-label="Progress">
        <ol role="list" class="overflow-hidden shadow rounded-md xl:flex xl:rounded-none xl:border-l xl:border-r xl:border-gray-200">
          <li v-for="(step, stepIdx) in steps" :key="step.id" class="relative bg-white overflow-hidden lg:flex-1">
            <div :class="[stepIdx === 0 ? 'rounded-t-md border-b-0' : '', stepIdx === steps.length - 1 ? 'rounded-b-md border-t-0' : '', 'overflow-hidden border border-gray-200 xl:border-0']">
              <div v-if="step.status === 'complete'" class="group">
                <span class="absolute left-0 top-0 h-full w-1 bg-transparent xl:bottom-0 xl:top-auto xl:h-1 xl:w-full" aria-hidden="true" />
                <span :class="[stepIdx !== 0 ? 'xl:pl-9' : '', 'flex items-start px-6 py-5 text-sm font-medium']">
                <span class="flex-shrink-0">
                  <span class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600">
                    <CheckIcon class="h-6 w-6 text-white" aria-hidden="true" />
                  </span>
                </span>
                <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                  <span class="text-sm font-medium">{{ step.name }}</span>
                  <span class="text-sm font-medium text-gray-500">{{ step.description }}</span>
                </span>
              </span>
              </div>
              <div v-else-if="step.status === 'current'" aria-current="step">
                <span class="absolute left-0 top-0 h-full w-1 bg-indigo-600 xl:bottom-0 xl:top-auto xl:h-1 xl:w-full" aria-hidden="true" />
                <span :class="[stepIdx !== 0 ? 'xl:pl-9' : '', 'flex items-start px-6 py-5 text-sm font-medium']">
                <span class="flex-shrink-0">
                  <span class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-indigo-600">
                    <span class="text-indigo-600">0{{ step.id }}</span>
                  </span>
                </span>
                <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                  <span class="text-sm font-medium text-indigo-600">{{ step.name }}</span>
                  <span class="text-sm font-medium text-gray-500">{{ step.description }}</span>
                </span>
              </span>
              </div>
              <div v-else class="group">
                <span class="absolute left-0 top-0 h-full w-1 bg-transparent xl:bottom-0 xl:top-auto xl:h-1 xl:w-full" aria-hidden="true" />
                <span :class="[stepIdx !== 0 ? 'xl:pl-9' : '', 'flex items-start px-6 py-5 text-sm font-medium']">
                <span class="flex-shrink-0">
                  <span class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gray-300">
                    <span class="text-gray-500">0{{ step.id }}</span>
                  </span>
                </span>
                <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                  <span class="text-sm font-medium text-gray-900">{{ step.name }}</span>
                  <span class="text-sm font-medium text-gray-500">{{ step.description }}</span>
                </span>
              </span>
              </div>
              <template v-if="stepIdx !== 0">
                <!-- Separator -->
                <div class="absolute inset-0 left-0 top-0 hidden w-3 xl:block" aria-hidden="true">
                  <svg class="h-full w-full text-gray-300" viewBox="0 0 12 82" fill="none" preserveAspectRatio="none">
                    <path d="M0.5 0V31L10.5 41L0.5 51V82" stroke="currentcolor" vector-effect="non-scaling-stroke" />
                  </svg>
                </div>
              </template>
            </div>
          </li>
        </ol>
      </nav>
    </div>

    <div class="mt-4">
      <template v-if="activeStep === 1">
        <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
          <div class="flex">
            <div class="flex-shrink-0">
              <ExclamationTriangleIcon class="h-5 w-5 text-yellow-400" aria-hidden="true" />
            </div>
            <div class="ml-3">
              <p class="text-sm text-yellow-700">
                Демострация состояния
                {{ ' ' }}
                <span @click="changeFlow" class="cursor-pointer ml-2 font-medium text-yellow-700 underline hover:text-yellow-600">
                Поменять сотояние
              </span>
              </p>
            </div>
          </div>
        </div>
        <h2 class="text-xl font-semibold pt-3 pb-5">Заявка на стажировку</h2>
        <!--        Анкета-->
        <div class="bg-white shadow sm:rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
              <h3 class="text-base font-semibold leading-6 text-gray-900">Заполните анкету</h3>
              <span class="flex-shrink-0 ml-3">
                  <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600">
                    <CheckIcon class="h-5 w-5 text-white" aria-hidden="true" />
                  </span>
              </span>
            </div>
            <div class="mt-2 sm:flex sm:items-start sm:justify-between">
              <div class="max-w-xl text-sm text-gray-500">
                <p>
                  Обратите внимание, что Ваша анкета обязательно будет просматриваться кадровыми специалистами при участии Вашей кандидатуры в конкурсах и вакансиях Правительства Москвы.
                </p>
              </div>
              <div class="mt-5 sm:ml-6 sm:mt-0 sm:flex sm:flex-shrink-0 sm:items-center">
                <base-button
                    type="primary"
                    class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm"
                    @click="openQuestionnaire"
                >
                  Заполнить
                </base-button>
              </div>
            </div>
          </div>
        </div>
        <!--        Эссе-->
        <div class="bg-white shadow sm:rounded-lg mt-4">
          <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
              <h3 class="text-base font-semibold leading-6 text-gray-900">Заполните эссе</h3>
              <span class="flex-shrink-0 ml-3">
                  <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600">
                    <CheckIcon class="h-5 w-5 text-white" aria-hidden="true" />
                  </span>
              </span>
            </div>
            <div class="mt-2 sm:flex sm:items-start sm:justify-between">
              <div class="max-w-xl text-sm text-gray-500">
                <p>
                  Обратите внимание, что Ваше эссе обязательно будет просматриваться кадровыми специалистами при участии Вашей кандидатуры в конкурсах и вакансиях Правительства Москвы.
                </p>
              </div>
              <div class="mt-5 sm:ml-6 sm:mt-0 sm:flex sm:flex-shrink-0 sm:items-center">
                <base-button
                    type="primary"
                    class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm"
                    @click="openEssay"
                >
                  Заполнить
                </base-button>
              </div>
            </div>
          </div>
        </div>
        <!--        Отправить заявку-->
        <base-button
            v-if="flow"
            type="primary"
            class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm mt-6"
            @click="sendApplication"
        >
          Отправить заявку
        </base-button>
        <!--        Набор заявок закрыт-->
        <div v-else class="mt-6">
          <div class="mx-auto max-w-2xl lg:mx-0">
            <p class="text-xl font-semibold leading-7 text-indigo-600">Прием завершен</p>
            <p class="mt-2 text-lg font-bold leading-8 text-gray-700">Мы Вым обязательно напомним о старте записи на стажировку.</p>
          </div>
        </div>
      </template>
      <template v-if="activeStep === 2">
        <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
          <div class="flex">
            <div class="flex-shrink-0">
              <ExclamationTriangleIcon class="h-5 w-5 text-yellow-400" aria-hidden="true" />
            </div>
            <div class="ml-3">
              <p class="text-sm text-yellow-700">
                Демострация состояния
                {{ ' ' }}
                <span @click="changeFlow" class="cursor-pointer ml-2 font-medium text-yellow-700 underline hover:text-yellow-600">
                Поменять сотояние
              </span>
              </p>
            </div>
          </div>
        </div>
        <h2 class="text-xl font-semibold pt-3 pb-5">Карьерная школа</h2>
        <!--        Карьерная школа-->
        <div class="bg-white shadow sm:rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
              <h3 class="text-base font-semibold leading-6 text-gray-900">Пройдите карьерную школу</h3>
              <span class="flex-shrink-0 ml-3">
                  <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600">
                    <CheckIcon class="h-5 w-5 text-white" aria-hidden="true" />
                  </span>
              </span>
            </div>
            <div class="mt-2 sm:flex sm:items-start sm:justify-between">
              <div class="max-w-xl text-sm text-gray-500">
                <p>
                  Узнай все о структуре Правительства Москвы и познакомься с лучшими городскими проектами.
                </p>
              </div>
              <div class="mt-5 sm:ml-6 sm:mt-0 sm:flex sm:flex-shrink-0 sm:items-center">
                <base-button
                    type="primary"
                    class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm"
                    @click="openSchool"
                >
                  Начать
                </base-button>
              </div>
            </div>
          </div>
        </div>
        <!--        Отправить заявку-->
        <base-button
            type="primary"
            class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm mt-6"
            @click="sendSchool"
        >
          Перейти к тестированию
        </base-button>
      </template>
      <template v-if="activeStep === 3">
        <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
          <div class="flex">
            <div class="flex-shrink-0">
              <ExclamationTriangleIcon class="h-5 w-5 text-yellow-400" aria-hidden="true" />
            </div>
            <div class="ml-3">
              <p class="text-sm text-yellow-700">
                Демострация состояния
                {{ ' ' }}
                <span @click="changeFlow" class="cursor-pointer ml-2 font-medium text-yellow-700 underline hover:text-yellow-600">
                Поменять сотояние
              </span>
              </p>
            </div>
          </div>
        </div>
        <h2 class="text-xl font-semibold pt-3 pb-5">Тестирование</h2>
        <!--        Тестирование-->
        <div class="bg-white shadow sm:rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
              <h3 class="text-base font-semibold leading-6 text-gray-900">Пройдите тестирование</h3>
              <span class="flex-shrink-0 ml-3">
                  <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600">
                    <CheckIcon class="h-5 w-5 text-white" aria-hidden="true" />
                  </span>
              </span>
            </div>
            <div class="mt-2 sm:flex sm:items-start sm:justify-between">
              <div class="max-w-xl text-sm text-gray-500">
                <p>
                  Пройди онлайн-тест на умение анализировать информацию, знание русского языка и компьютерную грамотность.
                </p>
              </div>
              <div class="mt-5 sm:ml-6 sm:mt-0 sm:flex sm:flex-shrink-0 sm:items-center">
                <base-button
                    type="primary"
                    class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm"
                    @click="openTest"
                >
                  Начать
                </base-button>
              </div>
            </div>
          </div>
        </div>
        <!--        Отправить заявку-->
        <base-button
            type="primary"
            class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm mt-6"
            @click="sendTest"
        >
          Перейти к кейс-чемпионату
        </base-button>
      </template>
      <template v-if="activeStep === 4">
        <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
          <div class="flex">
            <div class="flex-shrink-0">
              <ExclamationTriangleIcon class="h-5 w-5 text-yellow-400" aria-hidden="true" />
            </div>
            <div class="ml-3">
              <p class="text-sm text-yellow-700">
                Демострация состояния
                {{ ' ' }}
                <span @click="changeFlow" class="cursor-pointer ml-2 font-medium text-yellow-700 underline hover:text-yellow-600">
                Поменять сотояние
              </span>
              </p>
            </div>
          </div>
        </div>
        <h2 class="text-xl font-semibold pt-3 pb-5">Кейс-чемпионат</h2>
        <!--        Кейс-чемпионат-->
        <div class="bg-white shadow sm:rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
              <h3 class="text-base font-semibold leading-6 text-gray-900">Защити кейс-чемпионат</h3>
              <span class="flex-shrink-0 ml-3">
                  <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600">
                    <CheckIcon class="h-5 w-5 text-white" aria-hidden="true" />
                  </span>
              </span>
            </div>
            <div class="mt-2 sm:flex sm:items-start sm:justify-between">
              <div class="max-w-xl text-sm text-gray-500">
                <p>
                  Защити свой проект на кейс-чемпионате. Решайте реальные задачи от организаций Правительства Москвы, презентуя решения перед членами жюри.
                </p>
              </div>
              <div class="mt-5 sm:ml-6 sm:mt-0 sm:flex sm:flex-shrink-0 sm:items-center">
                <base-button
                    type="primary"
                    class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm"
                    @click="openCase"
                >
                  Начать
                </base-button>
              </div>
            </div>
          </div>
        </div>
        <!--        Отправить заявку-->
        <base-button
            type="primary"
            class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm mt-6"
            @click="sendCase"
        >
          Перейти к стажировкам
        </base-button>
      </template>
      <template v-if="activeStep === 5">
        <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
          <div class="flex">
            <div class="flex-shrink-0">
              <ExclamationTriangleIcon class="h-5 w-5 text-yellow-400" aria-hidden="true" />
            </div>
            <div class="ml-3">
              <p class="text-sm text-yellow-700">
                Демострация состояния
                {{ ' ' }}
                <span @click="changeFlow" class="cursor-pointer ml-2 font-medium text-yellow-700 underline hover:text-yellow-600">
                Поменять сотояние
              </span>
              </p>
            </div>
          </div>
        </div>
        <h2 class="text-xl font-semibold pt-3 pb-5">Ваши заявки на стажировки</h2>
        <!--        Кейс-чемпионат-->
        <div class="bg-white shadow sm:rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
              <h3 class="text-base font-semibold leading-6 text-gray-900">Защити кейс-чемпионат</h3>
              <span class="flex-shrink-0 ml-3">
                  <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600">
                    <CheckIcon class="h-5 w-5 text-white" aria-hidden="true" />
                  </span>
              </span>
            </div>
            <div class="mt-2 sm:flex sm:items-start sm:justify-between">
              <div class="max-w-xl text-sm text-gray-500">
                <p>
                  Защити свой проект на кейс-чемпионате. Решайте реальные задачи от организаций Правительства Москвы, презентуя решения перед членами жюри.
                </p>
              </div>
              <div class="mt-5 sm:ml-6 sm:mt-0 sm:flex sm:flex-shrink-0 sm:items-center">
                <base-button
                    type="primary"
                    class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm"
                    @click="openCase"
                >
                  Начать
                </base-button>
              </div>
            </div>
          </div>
        </div>
        <!--        Отправить заявку-->
        <base-button
            type="primary"
            class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm mt-6"
            @click="sendCase"
        >
          Перейти к стажировкам
        </base-button>
      </template>
    </div>
  </div>
</template>

<script>
import { ExclamationTriangleIcon } from '@heroicons/vue/20/solid'
import { CheckIcon } from '@heroicons/vue/24/outline'
import BaseButton from "@/components/UI/BaseButton.vue";

export default {
  name: "Cabinet",
  components: {
    BaseButton,
    CheckIcon,
    ExclamationTriangleIcon
  },
  data() {
    return {
      steps: [
        { id: 1, name: 'Заявка на стажировку', description: 'Заполнте анкету и эссе, и Вы сможете подать заявку на стажировку.', status: 'current' },
        { id: 2, name: 'Карьерная школа', description: 'Узнай все о структуре Правительства Москвы и познакомься с лучшими городскими проектами.', status: 'upcoming' },
        { id: 3, name: 'Тестирование', description: 'Пройди тест на анализ информации, знание русского языка и компьютерную грамотность.', status: 'upcoming' },
        { id: 4, name: 'Кейс-чемпионат', description: 'Защити свой проект на кейс-чемпионате.', status: 'upcoming' },
        { id: 5, name: 'Стажировка', description: 'Вливайся в команду Правительства Москвы в числе 125 лучших стажеров.', status: 'upcoming' },
      ],
      activeStep: 1,
      flow: false,
    }
  },
  methods: {
    changeFlow() {
      this.flow = !this.flow
    },
    openQuestionnaire() {
      this.$router.push(`/cabinet/questionnaire`)
    },
    openEssay() {
      this.$router.push(`/cabinet/essay`)
    },
    openSchool() {
      window.open('https://talent.mos.ru/internships/', "_blank");
    },
    openTest() {
      window.open('https://talent.mos.ru/internships/', "_blank");
    },
    openCase() {
      window.open('https://talent.mos.ru/internships/', "_blank");
    },
    sendApplication() {
      this.activeStep = 2
      this.steps = this.steps.map((item) => {
        if(item.id === this.activeStep) {
          return {
            ...item,
            status: 'current'
          }
        } else if (item.id < this.activeStep) {
          return {
            ...item,
            status: 'complete'
          }
        } else {
          return {
            ...item,
            status: 'upcoming'
          }
        }
      })
    },
    sendSchool() {
      this.activeStep = 3
      this.steps = this.steps.map((item) => {
        if(item.id === this.activeStep) {
          return {
            ...item,
            status: 'current'
          }
        } else if (item.id < this.activeStep) {
          return {
            ...item,
            status: 'complete'
          }
        } else {
          return {
            ...item,
            status: 'upcoming'
          }
        }
      })
    },
    sendTest() {
      this.activeStep = 4
      this.steps = this.steps.map((item) => {
        if(item.id === this.activeStep) {
          return {
            ...item,
            status: 'current'
          }
        } else if (item.id < this.activeStep) {
          return {
            ...item,
            status: 'complete'
          }
        } else {
          return {
            ...item,
            status: 'upcoming'
          }
        }
      })
    },
    sendCase() {
      this.activeStep = 5
      this.steps = this.steps.map((item) => {
        if(item.id === this.activeStep) {
          return {
            ...item,
            status: 'current'
          }
        } else if (item.id < this.activeStep) {
          return {
            ...item,
            status: 'complete'
          }
        } else {
          return {
            ...item,
            status: 'upcoming'
          }
        }
      })
    },
  },
  mounted() {
    // complete/current/upcoming
    this.steps = this.steps.map((item) => ({
      ...item,
      status: item.id === 1 ? 'current' : 'upcoming'
    }))
    this.activeStep = 1
    this.flow = true
  }
}
</script>

<style lang="scss" scoped>
</style>