<template>
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div
                    class="absolute inset-y-0 left-0 flex items-center sm:hidden"
                >
                    <!-- Mobile menu button-->
                    <button
                        @click="dropNav = !dropNav"
                        type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu"
                        aria-expanded="false"
                    >
                        <span class="sr-only">Open main menu</span>
                        <svg
                            class="block h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                        <svg
                            class="hidden h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
                <div
                    class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start"
                >
                    <router-link
                        class="flex-shrink-0 flex items-center mr-2"
                        :to="{ name: 'welcome' }"
                    >
                        <div class="flex-shrink-0 flex items-center">
                            <img
                                class="block lg:hidden h-8 w-auto"
                                src="img/LaraToursLogoWhite.png"
                                alt="Workflow"
                            />
                            <img
                                class="hidden lg:block h-8 w-auto"
                                src="img/LaraToursLogoWhite.png"
                                alt="Workflow"
                            />
                        </div>
                    </router-link>
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            <router-link
                                active-class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                v-if="user"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                :to="{ name: 'home' }"
                            >
                                Home
                            </router-link>

                            <router-link
                                active-class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                v-if="user"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                :to="{ name: 'test' }"
                            >
                                Test
                            </router-link>

                            <router-link
                                active-class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                v-if="user"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                :to="{ name: 'company' }"
                            >
                                Company
                            </router-link>

                            <router-link
                                active-class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                v-if="user"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                :to="{ name: 'tours' }"
                            >
                                Tours
                            </router-link>
                        </div>
                    </div>
                </div>
                <div
                    class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0"
                >
                    <div v-if="user" class="ml-3 relative">
                        <button
                            @click="dropNotif = !dropNotif"
                            type="button"
                            class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                        >
                            <span class="sr-only">View notifications</span>
                            <!-- Heroicon name: outline/bell -->
                            <svg
                                class="h-6 w-6"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                                />
                            </svg>
                        </button>
                        <div
                            v-if="dropNotif"
                            @click="dropNotif = !dropNotif"
                            class="origin-top-right absolute right-0 mt-2 w-max rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1"
                        >
                            <VerifyNotice
                                :id="id"
                                v-if="
                                    this.$route.name !== 'welcome' &&
                                    id &&
                                    !verified
                                "
                            />
                        </div>
                    </div>

                    <!-- Profile dropdown -->
                    <div v-if="user" class="ml-3 relative">
                        <div>
                            <button
                                type="button"
                                @click="drop = !drop"
                                class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >
                                <span class="sr-only">Open user menu</span>
                                <img
                                    class="h-8 w-8 rounded-full"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt=""
                                />
                            </button>
                        </div>
                        <div
                            v-if="drop"
                            @click="drop = !drop"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1"
                        >
                            <router-link
                                class="p-4 flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                                :to="{ name: 'settings' }"
                            >
                                <CogIcon
                                    class="h-6 w-6 text-gray-700 mr-2"
                                ></CogIcon>
                                Settings
                            </router-link>

                            <div
                                @click="logout"
                                class="p-4 flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out cursor-pointer"
                            >
                                <LogoutIcon
                                    class="h-6 w-6 text-gray-700 mr-2"
                                ></LogoutIcon>

                                Logout
                            </div>
                        </div>
                    </div>
                    <div v-else class="ml-3 relative">
                        <button>
                            <router-link
                                active-class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                :to="{ name: 'login' }"
                            >
                                Login
                            </router-link>
                        </button>
                        <button>
                            <router-link
                                active-class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                :to="{ name: 'register' }"
                            >
                                Register
                            </router-link>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div v-if="dropNav" @click="dropNav = !dropNav" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <router-link
                    :to="{ name: 'home' }"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                    active-class="bg-gray-800 text-white block px-3 py-2 rounded-md text-base font-medium"
                >
                    Home
                </router-link>

                <router-link
                    :to="{ name: 'test' }"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                    active-class="bg-gray-800 text-white block px-3 py-2 rounded-md text-base font-medium"
                >
                    Test
                </router-link>

                <router-link
                    :to="{ name: 'company' }"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                    active-class="bg-gray-800 text-white block px-3 py-2 rounded-md text-base font-medium"
                >
                    Company
                </router-link>

                <router-link
                    :to="{ name: 'tours' }"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                    active-class="bg-gray-800 text-white block px-3 py-2 rounded-md text-base font-medium"
                >
                    Tours
                </router-link>
            </div>
        </div>
    </nav>
</template>
<script>
import { CogIcon, LogoutIcon, ChevronDownIcon } from "@heroicons/vue/outline";
import VerifyNotice from "./VerifyNotice.vue";

export default {
    created: function () {
        if (this.$store.getters.user) {
            let self = this;
            window.addEventListener("click", function (e) {
                if (
                    self.$refs.dropMenu &&
                    !self.$refs.dropMenu.contains(e.target)
                ) {
                    self.drop = false;
                }
            });
        }
    },
    components: { CogIcon, LogoutIcon, ChevronDownIcon, VerifyNotice },
    data() {
        return {
            drop: false,
            dropNotif: false,
            dropNav: false,
        };
    },
    computed: {
        user() {
            return this.$store.getters.user;
        },
        id() {
            return this.$store.getters.id;
        },
        verified() {
            return this.$store.getters.verified;
        },
    },
    methods: {
        async logout() {
            await this.$store.dispatch("logout");
            this.$router.push({ name: "login" });
        },
    },
};
</script>
