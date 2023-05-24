<template>
  <div v-if="value">
    <div class="px-4 py-6 sm:px-6 lg:grid lg:grid-cols-12 lg:gap-x-8 lg:p-8">
      <div class="sm:flex lg:col-span-7">
        <div class="aspect-h-1 aspect-w-1 w-full flex-shrink-0 overflow-hidden rounded-lg sm:aspect-none sm:h-40 sm:w-40">
          <img :src="value.imageSrc" :alt="value.imageAlt" class="h-full w-full object-cover object-center sm:h-full sm:w-full" />
        </div>

        <div class="mt-6 sm:ml-6 sm:mt-0">
          <h3 class="text-base font-medium text-gray-900">
            <a :href="value.href">{{ value.name }}</a>
          </h3>
          <p class="mt-2 text-sm font-medium text-gray-900">${{ value.price }}</p>
          <p class="mt-3 text-sm text-gray-500">{{ value.description }}</p>
        </div>
      </div>

      <div class="mt-6 lg:col-span-5 lg:mt-0">
        <dl class="grid grid-cols-2 gap-x-6 text-sm">
          <div>
            <dt class="font-medium text-gray-900">Delivery address</dt>
            <dd class="mt-3 text-gray-500">
              <span class="block">{{ value.address[0] }}</span>
              <span class="block">{{ value.address[1] }}</span>
              <span class="block">{{ value.address[2] }}</span>
            </dd>
          </div>
          <div>
            <dt class="font-medium text-gray-900">Shipping updates</dt>
            <dd class="mt-3 space-y-3 text-gray-500">
              <p>{{ value.email }}</p>
              <p>{{ value.phone }}</p>
              <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">Edit</button>
            </dd>
          </div>
        </dl>
      </div>
    </div>

    <div class="border-t border-gray-200 px-4 py-6 sm:px-6 lg:p-8">
      <h4 class="sr-only">Status</h4>
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
  </div>
</template>

<script>

export default {
  name: "InternshipsCard",
  props: {
    value: {
      type: Object,
      default: null,
    },
  },
  components: {
  },
  data() {
    return {
    }
  },
}
</script>

<style lang="scss" scoped>
</style>