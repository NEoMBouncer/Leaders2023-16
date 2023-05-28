<template>
  <div class="flex flex-col">
    <h1 class="text-2xl font-semibold pb-5">Стажировки</h1>
    <template v-if="!loading">
      <div class="flex flex-col mb-6">
        <div class="flex justify-between">
          <div class="flex">
            <base-input
                label="Поиск"
                v-model="search"
            />
            <base-select
                class="ml-3 max-w-xs w-full"
                select-label="Направление"
                v-model="direction"
                :options="directoriesOptions"
                label="label"
            />
          </div>
          <div class="flex text-sm items-center w-fit text-indigo-600 hover:text-indigo-900 cursor-pointer" @click="onMap">
            <MapIcon class="h-5 w-5 mr-2"/>
            Посмотреть на карте
          </div>
        </div>
        <div @click="clearFilters" class="flex items-center text-gray-600 hover:text-gray-800 cursor-pointer text-sm mt-2">
          <x-mark-icon class="w-4 h-4 mr-1.5" />
          Сбросить фильтры
        </div>
      </div>
      <YandexMapPage
          v-if="isMap"
          :coordsMarket="[]"
          class="mb-5"
          @closeMap="closeMap"
      />
      <div class="mb-6 space-y-3">
        <internships-card
            class="border-b border-t border-gray-200 bg-white shadow-sm sm:rounded-lg sm:border"
            v-for="product in internships" :key="product.id"
            :value="product"
        />
      </div>
    </template>
    <loading v-else/>
  </div>
</template>

<script>

import InternshipsCard from "@/components/InternshipsCard.vue";
import BaseInput from "@/components/UI/BaseInput.vue";
import BaseSelect from "@/components/UI/BaseSelect.vue";
import {XMarkIcon, MapIcon} from "@heroicons/vue/24/outline";
import {mapActions} from "vuex";
import Loading from "@/components/Loading.vue";
import YandexMapPage from "@/components/Map/YandexMap.vue";

export default {
  name: "Internships",
  components: {
    YandexMapPage,
    Loading,
    XMarkIcon, BaseSelect, BaseInput,
    InternshipsCard,
    MapIcon
  },
  data() {
    return {
      loading: false,
      search: '',
      direction: null,
      directoriesOptions: [],
      internships: [
        {
          id: 1,
          name: 'Название',
          description:
              'This durable and portable insulated tumbler will keep your beverage at the perfect temperature during your next adventure.',
          href: '/cabinet/internships/1',
          direction: 'IT-город',
          status: 'Preparing to ship',
          step: 1,
          date: 'March 24, 2021',
          datetime: '2021-03-24',
          address: ['Floyd Miles', '7363 Cynthia Pass', 'Toronto, ON N3Y 4H8'],
          email: 'f•••@example.com',
          phone: '1•••••••••40',
          imageSrc: 'https://tailwindui.com/img/ecommerce-images/confirmation-page-03-product-01.jpg',
          imageAlt: 'Insulated bottle with white base and black snap lid.',
        },
        {
          id: 2,
          name: 'Название 2',
          description: 'This contemporary wristwatch has a clean, minimalist look and high quality components.',
          href: '/cabinet/internships/2',
          direction: 'Медийный город',
          status: 'Shipped',
          step: 0,
          date: 'March 23, 2021',
          datetime: '2021-03-23',
          address: ['Floyd Miles', '7363 Cynthia Pass', 'Toronto, ON N3Y 4H8'],
          email: 'f•••@example.com',
          phone: '1•••••••••40',
          imageSrc: 'https://tailwindui.com/img/ecommerce-images/confirmation-page-03-product-02.jpg',
          imageAlt:
              'Arm modeling wristwatch with black leather band, white watch face, thin watch hands, and fine time markings.',
        },
        // More products...
      ],
      isMap: false
    }
  },
  methods: {
    ...mapActions('cabinet', ['getDirections']),
    clearFilters() {
      this.search = ''
      this.direction = null
    },
    onMap() {
      this.isMap = !this.isMap
    },
    closeMap() {
      this.isMap = false
    }
  },
  async mounted() {
    this.loading = true
    await this.getDirections().then((res) => {
      this.directoriesOptions = res?.map((item) => ({
        label: item?.title || '',
        value: item?.id || ''
      })) || []
    })
    this.loading = false
  }
}
</script>

<style lang="scss" scoped>
</style>