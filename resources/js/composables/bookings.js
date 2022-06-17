import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useBooking() {
    const bookings = ref([]);
    const booking = ref([]);
    const assigned_tour = ref([]);
    const router = useRouter();
    const errors = ref("");

    const getBookings = async () => {
        let response = await axios.get("/api/booking");
        bookings.value = response.data.data;
    };

    const getBooking = async (id) => {
        let response = await axios.get("/api/booking/" + id);
        booking.value = {
            ...response.data.data,
            removed_passengers: [],
        };
        assigned_tour.value = response.data.data.tour;
    };

    const storeBooking = async (data) => {
        errors.value = "";
        try {
            await axios.post("/api/booking", data);
            await router.push({ name: "tours" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const updateBooking = async (id) => {
        errors.value = "";
        try {
            await axios.put("/api/booking/" + id, booking.value);
            await router.push({ name: "bookings" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const destroyBooking = async (id) => {
        await axios.delete("/api/booking/" + id);
    };

    const destroyBookingDate = async (id) => {
        await axios.delete("/api/booking/date/" + id);
    };

    return {
        errors,
        booking,
        bookings,
        getBooking,
        getBookings,
        storeBooking,
        updateBooking,
        destroyBooking,
        assigned_tour,
        destroyBookingDate,
    };
}
