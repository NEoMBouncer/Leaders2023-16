<template>
  <div class="flex flex-col">
    <h1 class="text-2xl font-semibold pb-5">Стажировки</h1>
    <div class="mb-6 space-y-3">
      <internships-card
          class="border-b border-t border-gray-200 bg-white shadow-sm sm:rounded-lg sm:border"
          v-for="product in internships" :key="product.id"
          :value="product"
      />
    </div>
  </div>
</template>

<script>

import InternshipsCard from "@/components/InternshipsCard.vue";

export default {
  name: "Internships",
  components: {
    InternshipsCard
  },
  data() {
    return {
      internships: [
        {
          id: 1,
          name: 'Nomad Tumbler',
          description:
              'This durable and portable insulated tumbler will keep your beverage at the perfect temperature during your next adventure.',
          href: '#',
          price: '35.00',
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
          name: 'Minimalist Wristwatch',
          description: 'This contemporary wristwatch has a clean, minimalist look and high quality components.',
          href: '#',
          price: '149.00',
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
      ]
    }
  },
}
</script>

<style lang="scss" scoped>
</style>