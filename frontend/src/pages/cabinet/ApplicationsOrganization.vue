<template>
  <div class="flex flex-col">
    <div class="flex sm:flex-row flex-col justify-between pb-5">
      <h1 class="text-2xl font-semibold">Стажировки</h1>
      <base-button
          type="primary"
          class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm mt-3 sm:mt-0"
          @click="openCreate"
      >
        Создать стажировку
      </base-button>
    </div>
    <template v-if="!loading">
      <div class="mb-6 space-y-3">
        <internships-card
            class="border-b border-t border-gray-200 bg-white shadow-sm sm:rounded-lg sm:border"
            v-for="product in internships" :key="product.id"
            :value="product"
            isOrganization
        />
      </div>
    </template>
    <loading v-else/>
  </div>
</template>

<script>

import {ExclamationTriangleIcon} from "@heroicons/vue/20/solid";
import InternshipsCard from "@/components/InternshipsCard.vue";
import Loading from "@/components/Loading.vue";
import BaseButton from "@/components/UI/BaseButton.vue";

export default {
  name: "ApplicationsOrganization",
  components: {
    BaseButton,
    Loading,
    InternshipsCard,
    ExclamationTriangleIcon
  },
  data() {
    return {
      loading: false,
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
    }
  },
  computed: {
  },
  methods: {
    openCreate() {
      this.$router.push('/cabinet/applications-organization/create');
    }
  },
  mounted() {
    this.loading = true
    this.loading = false
  }
}
</script>

<style lang="scss" scoped>
</style>