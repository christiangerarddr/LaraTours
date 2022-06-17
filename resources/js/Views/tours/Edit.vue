<template>
    <div
        class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md"
    >
        <div
            class="max-w-full rounded overflow-hidden shadow-lg px-4 pb-4 pt-8 bg-white"
        >
            <div v-if="errors">
                <div
                    v-for="(v, k) in errors"
                    :key="k"
                    class="bg-red-500 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0"
                >
                    <p v-for="error in v" :key="error" class="text-sm">
                        {{ error }}
                    </p>
                </div>
            </div>

            <form class="space-y-6" @submit.prevent="saveTour">
                <div class="relative z-0 w-full mb-6 group">
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        required
                        v-model="tour.name"
                    />
                    <label
                        for="name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >
                        Name
                    </label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input
                        type="text"
                        name="itenerary"
                        id="itenerary"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        required
                        v-model="tour.itenerary"
                    />
                    <label
                        for="itenerary"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >
                        Itenerary
                    </label>
                </div>

                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Tour Available Dates
                            <span
                                class="float-right cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                @click="addDateInput()"
                            >
                                Add Date
                            </span>
                        </h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <table
                            class="min-w-full border divide-y divide-gray-200"
                        >
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50">Date</th>
                                    <th class="px-6 py-3 bg-gray-50">Action</th>
                                </tr>
                            </thead>
                            <tbody
                                class="bg-white divide-y divide-gray-200 divide-solid"
                            >
                                <template
                                    v-for="(item, index) in tour.tour_dates"
                                    :key="index"
                                    id="multipleInputs"
                                >
                                    <tr class="bg-white">
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
                                        >
                                            <div
                                                class="relative z-0 w-full mb-6 group"
                                            >
                                                <input
                                                    type="date"
                                                    name="itenerary"
                                                    id="itenerary"
                                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    required
                                                    v-model="
                                                        tour.tour_dates[index]
                                                            .date
                                                    "
                                                />
                                                <label
                                                    for="itenerary"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                                                >
                                                    Date</label
                                                >
                                            </div>
                                        </td>
                                        <td>
                                            <button
                                                @click.prevent="
                                                    removeOrToggleDateInput(
                                                        item,
                                                        index
                                                    )
                                                "
                                                v-if="
                                                    item.status ||
                                                    !item.created_at
                                                "
                                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:red-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:red-blue-800"
                                            >
                                                <span v-if="item.status">
                                                    Disble
                                                </span>

                                                <span v-if="!item.created_at">
                                                    Remove
                                                </span>
                                            </button>

                                            <button
                                                @click.prevent="
                                                    removeOrToggleDateInput(
                                                        item,
                                                        index
                                                    )
                                                "
                                                v-if="
                                                    item.created_at &&
                                                    !item.status
                                                "
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:blue-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:blue-blue-800"
                                            >
                                                <span> Enable </span>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
                <router-link
                    :to="{
                        name: 'tours',
                    }"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 mr-2"
                >
                    Cancle
                </router-link>
                <button
                    type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import useTour from "../../composables/tours";
import { onMounted } from "vue";

export default {
    props: {
        id: {
            required: true,
            type: String,
        },
    },

    setup(props) {
        const { errors, tour, getTour, updateTour, destroyTourDate } =
            useTour();

        onMounted(getTour(props.id));

        const saveTour = async () => {
            await updateTour(props.id);
        };

        const deleteTourDate = async (id) => {
            if (id) await destroyTourDate(id);
        };

        return {
            errors,
            tour,
            saveTour,
            deleteTourDate,
        };
    },
    methods: {
        addDateInput: function () {
            this.tour.tour_dates.push({});
        },
        removeOrToggleDateInput: function (tourDate, index) {
            if (!tourDate.id) {
                this.tour.tour_dates.splice(index, 1);
            } else {
                this.tour.tour_dates[index]["status"] =
                    !this.tour.tour_dates[index]["status"];
            }
        },
    },
};
</script>
