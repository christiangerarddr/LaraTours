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

            <form class="space-y-6" @submit.prevent="saveBooking">
                <div class="relative z-0 w-full mb-6 group">
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="pl-2.5 text-lg font-medium block py-2.5 px-0 w-full text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        required
                        disabled
                        :value="assigned_tour.name"
                    />
                    <label
                        for="name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >
                        Tour Name
                    </label>
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <div class="flex justify-start">
                        <div class="mb-3 xl:w-96">
                            <select
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                name="tour_date"
                                id="tour_date"
                            >
                                <option selected>
                                    {{ booking.tour_date }}
                                </option>
                                <template
                                    v-for="tour_date in assigned_tour.tour_dates"
                                    :key="tour_date.id"
                                >
                                    <option>
                                        {{ tour_date.date }}
                                    </option>
                                </template>
                            </select>
                            <label
                                for="tour_date"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                            >
                                Tour Date
                            </label>
                        </div>
                    </div>
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <div class="flex justify-start">
                        <div class="mb-3 xl:w-96">
                            <select
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                name="status"
                                id="status"
                                required
                                v-model="booking.status"
                            >
                                <option :value="1">Submitted</option>
                                <option :value="0">Cancelled</option>
                            </select>
                            <label
                                for="status"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                            >
                                Status
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Passengers
                            <span
                                class="float-right cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                @click="addPassengerInput()"
                            >
                                Add Passenger
                            </span>
                        </h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <template
                            v-for="(item, index) in booking.passengers"
                            :key="index"
                            id="multipleInputs"
                        >
                            <div class="mt-10 sm:mt-0">
                                <div
                                    class="md:grid md:grid-cols-3 md:gap-6 p-6"
                                >
                                    <div class="md:col-span-1">
                                        <div class="px-4 sm:px-0">
                                            <h3
                                                class="text-lg font-medium leading-6 text-gray-900"
                                            >
                                                Passenger Information
                                            </h3>
                                            <p
                                                class="mt-1 text-sm text-gray-600"
                                            >
                                                Use your valid email to receive
                                                our updates
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-5 md:mt-0 md:col-span-2">
                                        <div
                                            class="shadow overflow-hidden sm:rounded-md"
                                        >
                                            <div
                                                class="px-4 py-5 bg-white sm:p-6"
                                            >
                                                <div
                                                    class="grid grid-cols-6 gap-6"
                                                >
                                                    <div
                                                        class="col-span-6 sm:col-span-3"
                                                    >
                                                        <label
                                                            for="first-name"
                                                            class="block text-sm font-medium text-gray-700"
                                                        >
                                                            First name
                                                        </label>
                                                        <input
                                                            type="text"
                                                            name="first-name"
                                                            id="first-name"
                                                            autocomplete="given-name"
                                                            required
                                                            v-model="
                                                                booking
                                                                    .passengers[
                                                                    index
                                                                ].given_name
                                                            "
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                        />
                                                    </div>

                                                    <div
                                                        class="col-span-6 sm:col-span-3"
                                                    >
                                                        <label
                                                            for="last-name"
                                                            class="block text-sm font-medium text-gray-700"
                                                        >
                                                            Surname
                                                        </label>
                                                        <input
                                                            type="text"
                                                            name="last-name"
                                                            id="last-name"
                                                            autocomplete="family-name"
                                                            required
                                                            v-model="
                                                                booking
                                                                    .passengers[
                                                                    index
                                                                ].surname
                                                            "
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                        />
                                                    </div>

                                                    <div
                                                        class="col-span-6 sm:col-span-3"
                                                    >
                                                        <label
                                                            for="email-address"
                                                            class="block text-sm font-medium text-gray-700"
                                                        >
                                                            Email address
                                                        </label>
                                                        <input
                                                            type="text"
                                                            name="email-address"
                                                            id="email-address"
                                                            autocomplete="email"
                                                            required
                                                            v-model="
                                                                booking
                                                                    .passengers[
                                                                    index
                                                                ].email
                                                            "
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                        />
                                                    </div>

                                                    <div
                                                        class="col-span-6 sm:col-span-3"
                                                    >
                                                        <label
                                                            for="email-address"
                                                            class="block text-sm font-medium text-gray-700"
                                                        >
                                                            Mobile
                                                        </label>
                                                        <input
                                                            type="text"
                                                            name="email-address"
                                                            id="email-address"
                                                            autocomplete="email"
                                                            required
                                                            v-model="
                                                                booking
                                                                    .passengers[
                                                                    index
                                                                ].mobile
                                                            "
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                        />
                                                    </div>

                                                    <div
                                                        class="col-span-6 sm:col-span-3"
                                                    >
                                                        <label
                                                            for="email-address"
                                                            class="block text-sm font-medium text-gray-700"
                                                        >
                                                            Passport
                                                        </label>
                                                        <input
                                                            type="text"
                                                            name="email-address"
                                                            id="email-address"
                                                            autocomplete="email"
                                                            required
                                                            v-model="
                                                                booking
                                                                    .passengers[
                                                                    index
                                                                ].passport
                                                            "
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                        />
                                                    </div>

                                                    <div
                                                        class="col-span-6 sm:col-span-3"
                                                    >
                                                        <label
                                                            for="email-address"
                                                            class="block text-sm font-medium text-gray-700"
                                                        >
                                                            Date of birth
                                                        </label>
                                                        <input
                                                            type="date"
                                                            name="email-address"
                                                            id="email-address"
                                                            autocomplete="email"
                                                            required
                                                            v-model="
                                                                booking
                                                                    .passengers[
                                                                    index
                                                                ].birth_date
                                                            "
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                        />
                                                    </div>

                                                    <div
                                                        class="col-span-6 sm:col-span-6"
                                                    >
                                                        <label
                                                            for="email-address"
                                                            class="block text-sm font-medium text-gray-700"
                                                        >
                                                            Special Request
                                                        </label>
                                                        <textarea
                                                            id="message"
                                                            rows="4"
                                                            required
                                                            v-model="
                                                                booking
                                                                    .passengers[
                                                                    index
                                                                ].pivot
                                                                    .special_request
                                                            "
                                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Your message..."
                                                        ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="px-4 py-3 bg-gray-50 text-right sm:px-6"
                                            >
                                                <button
                                                    @click.prevent="
                                                        removePassengerInput(
                                                            booking.passengers[
                                                                index
                                                            ],
                                                            index
                                                        )
                                                    "
                                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                >
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <router-link
                    :to="{
                        name: 'bookings',
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
import useBooking from "../../composables/bookings";
import { onMounted } from "vue";

export default {
    props: {
        id: {
            required: true,
            type: String,
        },
    },

    setup(props) {
        const { assigned_tour, errors, booking, getBooking, updateBooking } =
            useBooking();

        onMounted(getBooking(props.id));

        const saveBooking = async () => {
            await updateBooking(props.id);
        };

        return {
            assigned_tour,
            errors,
            booking,
            saveBooking,
        };
    },
    methods: {
        addPassengerInput: function () {
            this.booking.passengers.push({
                status: 1,
                pivot: {
                    special_request: "",
                },
                birth_date: "",
                email: "",
                given_name: "",
                mobile: "",
                passport: "",
                surname: "",
            });
        },
        removePassengerInput: function (passenger, index) {
            if (passenger.id) {
                this.booking.removedPassengers.push(passenger);
            }
            this.booking.passengers.splice(index, 1);
        },
    },
};
</script>
