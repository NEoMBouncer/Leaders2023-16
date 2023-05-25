<template>
  <div class="flex flex-col">
    <h1 class="text-2xl font-semibold mb-5">Эссе</h1>
    <span class="text-gray-500 text-sm mb-3">
      Кратко сформулируйте Ваши профессиональные достижения за последние 5 лет работы, а также при желании ответьте на вопросы ниже. Под профессиональными достижениями понимаются успешно реализованные проекты, достигнутые цели, Ваши конкурентные преимущества.
    </span>
    <span class="text-gray-500 text-sm">
      Обратите внимание, что Ваше эссе обязательно будет просматриваться кадровыми специалистами при участии Вашей кандидатуры в конкурсах и вакансиях Правительства Москвы.
    </span>
    <div class="mt-6 max-w-xl">
      <base-select
          label="label"
          star
          select-label="Тема"
          v-model="theme"
          :options="themeOptions"
      />
      <base-input
          class="mt-3"
          star
          v-model="name"
          label="Название"
      />
      <base-textarea
          class="mt-3"
          star
          v-model="essay"
          label="Эссе"
      />
      <base-button
          class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm mt-6"
      >
        Сохранить
      </base-button>
    </div>
  </div>
</template>

<script>

import BaseButton from "@/components/UI/BaseButton.vue";
import BaseSelect from "@/components/UI/BaseSelect.vue";
import BaseInput from "@/components/UI/BaseInput.vue";
import BaseTextarea from "@/components/UI/BaseTextarea.vue";

export default {
  name: "Essay",
  components: {
    BaseTextarea,
    BaseInput,
    BaseSelect,
    BaseButton
  },
  data() {
    return {
      theme: '',
      themeOptions: [
        {
          label: 'Мои три главных достижения за последние 5 лет',
          value: '1'
        },
        {
          label: 'Почему я хочу работать в Правительстве Москвы',
          value: '2'
        },
        {
          label: 'Почему я хочу работать в ресурсном центре',
          value: '3'
        },
        {
          label: 'Без темы',
          value: '0'
        },
      ],
      name: '',
      essay: ''
    }
  },
}
</script>

<style lang="scss" scoped>
</style>