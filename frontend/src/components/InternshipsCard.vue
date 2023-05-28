<template>
  <div v-if="value">
    <div class="px-4 py-6 sm:px-6 lg:grid lg:grid-cols-12 lg:gap-x-6">
      <div class="sm:flex lg:col-span-7">
        <router-link :to="value.href" class="aspect-h-1 aspect-w-1 w-full flex-shrink-0 overflow-hidden rounded-lg sm:aspect-none sm:h-40 sm:w-40">
          <img src="../assets/images/logo.png" :alt="logo" class="h-full w-full object-contain object-center sm:h-full sm:w-full" />
        </router-link>

        <div class="mt-6 sm:ml-6 sm:mt-0">
          <h3 class="text-base font-medium text-gray-900">
            <router-link :to="value.href">{{ value.name }}</router-link>
          </h3>
          <div class="flex mt-2">
            <div class="mr-2 flex items-center">
              <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating" :class="[4 > rating ? 'text-indigo-500' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']" aria-hidden="true" />
            </div>
            <p class="text-sm font-medium text-gray-900">Компания</p>
          </div>
          <p class="mt-2 text-sm text font-medium text-gray-900">От 20000 руб</p>
          <p class="mt-1 text-sm font-medium text-gray-900">{{ value.direction }}</p>
          <p class="mt-2 text-sm text-gray-500">{{ value.description }}</p>
        </div>
      </div>

      <div class="mt-6 lg:col-span-5 lg:mt-0">
        <dl class="grid grid-cols-2 gap-x-6 text-sm">
          <div>
            <dt class="font-medium text-gray-900">Адрес стажировки</dt>
            <dd class="mt-3 text-gray-500">
              <span class="block">{{ value.address[0] }}</span>
              <span class="block">{{ value.address[1] }}</span>
              <span class="block">{{ value.address[2] }}</span>
            </dd>
          </div>
          <div>
            <dt class="font-medium text-gray-900">Наставник</dt>
            <dd class="mt-3 flex items-center flex-col w-fit xl:flex-row text-gray-500">
              <img
                  src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                  alt="author"
                  class="h-12 w-12 rounded-full"
              />

              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900 mt-2 xl:mt-0">Иван Иванович</p>
                <div class="mt-2 flex items-center">
                  <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating" :class="[4 > rating ? 'text-indigo-500' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']" aria-hidden="true" />
                </div>
              </div>
            </dd>
          </div>
        </dl>
      </div>
    </div>

    <div v-if="!isOrganization" class="border-t border-gray-200 px-4 py-6 sm:px-6">
      <p class="text-sm font-medium text-gray-900">
        {{ value.status }} on <time :datetime="value.datetime">{{ value.date }}</time>
      </p>
      <div class="mt-6" aria-hidden="true">
        <div class="overflow-hidden rounded-full bg-gray-200">
          <div class="h-2 rounded-full bg-indigo-600" :style="{ width: `calc((${value.step} * 2 + 1) / 8 * 100%)` }" />
        </div>
        <div class="mt-6 hidden grid-cols-4 text-sm font-medium text-gray-600 sm:grid">
          <div class="text-indigo-600">Заявка отправлена</div>
          <div :class="[value.step > 0 ? 'text-indigo-600' : '', 'text-center']">Решение задания</div>
          <div :class="[value.step > 1 ? 'text-indigo-600' : '', 'text-center']">Одобрение наставника</div>
          <div :class="[value.step > 2 ? 'text-indigo-600' : '', 'text-right']">Потверждение кадрового специалиста</div>
        </div>
      </div>
    </div>
    <div v-if="isOrganization" class="border-t border-gray-200 px-4 py-6 sm:px-6">
      <div class="flex justify-between">
<!--         <span class="w-fit inline-flex items-center gap-x-1.5 rounded-md bg-red-100 px-2 py-1 font-medium text-red-700">-->
<!--            <svg class="h-2 w-2 fill-red-500" viewBox="0 0 6 6" aria-hidden="true">-->
<!--              <circle cx="3" cy="3" r="3" />-->
<!--            </svg>-->
<!--            Отклонена-->
<!--         </span>-->
<!--        <span class="w-fit inline-flex items-center gap-x-1.5 rounded-md bg-green-100 px-2 py-1 font-medium text-green-700">-->
<!--            <svg class="h-2 w-2 fill-green-500" viewBox="0 0 6 6" aria-hidden="true">-->
<!--              <circle cx="3" cy="3" r="3" />-->
<!--            </svg>-->
<!--            Опубликована-->
<!--         </span>-->
        <span class="w-fit inline-flex items-center gap-x-1.5 rounded-md bg-blue-100 px-2 py-1 font-medium text-blue-700">
            <svg class="h-2 w-2 fill-blue-500" viewBox="0 0 6 6" aria-hidden="true">
              <circle cx="3" cy="3" r="3" />
            </svg>
            На модерации
         </span>
        <div class="flex">
          <div class="text-sm text-green-500 hover:text-green-600 cursor-pointer flex items-center mr-3">
            <PencilIcon class="h-4 w-4 flex-shrink-0 mr-2" aria-hidden="true" />
            <span class="hidden sm:flex">Редактировать</span>
          </div>
          <div class="text-sm ml-3 text-red-500 hover:text-red-600 cursor-pointer flex items-center">
            <TrashIcon class="h-4 w-4 flex-shrink-0 mr-2" aria-hidden="true" />
            <span class="hidden sm:flex">Удалить</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {StarIcon, PencilIcon, TrashIcon} from "@heroicons/vue/20/solid";

export default {
  name: "InternshipsCard",
  props: {
    value: {
      type: Object,
      default: null,
    },
    isOrganization: {
      type:    Boolean,
      default: false,
    },
  },
  components: {
    StarIcon, PencilIcon, TrashIcon
  },
  data() {
    return {
    }
  },
}
</script>

<style lang="scss" scoped>
</style>