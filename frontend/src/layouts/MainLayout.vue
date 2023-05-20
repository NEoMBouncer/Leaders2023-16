<template>
	<div>
		<div class="flex flex-col">
			<div class="sticky top-0 z-10 flex h-16 flex-shrink-0 bg-white shadow px-6">
				<div class="flex flex-1 justify-between px-4">
					<div class="flex items-center w-2/3">
            <router-link to="/" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
              Dev+
            </router-link>
<!--            <div class="flex items-center ml-3">-->
<!--              <router-link to="/" class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">-->
<!--                <div class="flex items-center">-->
<!--                  <ChevronRightIcon class="mr-2 rotate-180 h-4 w-4 flex-shrink-0" aria-hidden="true" />-->
<!--                  Назад-->
<!--                </div>-->
<!--              </router-link>-->
<!--            </div>-->
					</div>
          <!-- Profile dropdown -->
					<div class="ml-4 flex items-center md:ml-6">
						<Menu as="div" class="relative ml-3">
							<div>
								<MenuButton class="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
									<span class="sr-only">Open user menu</span>
									<img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
								</MenuButton>
							</div>
							<transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
								<MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
									<MenuItem v-slot="{ active }">
                    <button
                        :class="[active ? 'bg-gray-100' : '', 'w-full items-start justify-start flex px-4 py-2 text-sm text-gray-700']"
                        @click="isSignOut"
                    >
                      Выход
                    </button>
									</MenuItem>
								</MenuItems>
							</transition>
						</Menu>
					</div>
				</div>
			</div>
			
			<main class="layout-content">
				<div class="py-6">
					<div class="mx-auto">
						<router-view class="flex-1" v-slot="{Component}">
							<transition name="fade" mode="out-in">
								<component :is="Component"/>
							</transition>
						</router-view>
					</div>
				</div>
			</main>
		</div>
	</div>
</template>


<script>
import {
	Dialog,
	DialogPanel,
	Menu,
	MenuButton,
	MenuItem,
	MenuItems,
	TransitionChild,
	TransitionRoot,
} from '@headlessui/vue'
import {
	Bars3BottomLeftIcon,
	BellIcon,
	CalendarIcon,
	ChartBarIcon,
	FolderIcon,
	HomeIcon,
	InboxIcon,
	UsersIcon,
	XMarkIcon,
  ChevronRightIcon
} from '@heroicons/vue/24/outline'
import {mapActions, mapState} from "vuex";

export default {
	name: 'MainLayout',
	components: {
		Bars3BottomLeftIcon,
		BellIcon,
		CalendarIcon,
		ChartBarIcon,
		FolderIcon,
		HomeIcon,
		InboxIcon,
		UsersIcon,
		XMarkIcon,
		Dialog,
		DialogPanel,
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		TransitionChild,
		TransitionRoot,
    ChevronRightIcon
	},
	data() {
		return {
			sidebarOpen: false,
			userNavigation: [
				{ name: 'Выйти', href: '#' },
			]
		}
	},
  methods: {
    ...mapActions('auth', ['signOut']),
    isSignOut () {
      this.signOut()
      this.$router.push('/login');
    },
  }
};
</script>

<style lang="scss" scoped>

.layout--main {
	display: flex;
	flex-direction: column;
	flex: 1 0;
	min-height: 100vh;
	justify-content: space-between;
	
	.main-content {
		display: flex;
		flex: 1 0;
		background-color: #F8F9FB;
	}
	
	// router view
	.fade-enter-active,
	.fade-leave-active {
		transition: opacity 0.3s ease;
	}
	
	.fade-enter-from,
	.fade-leave-to {
		opacity: 0;
	}
}
.layout-content {
  @apply flex-1 bg-gray-100;
  min-height: calc(100vh - 64px);
  height: 100%;
}
</style>
