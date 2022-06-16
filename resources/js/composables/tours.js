import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useTour() {
    const tours = ref([]);
    const tour = ref([]);
    const router = useRouter();
    const errors = ref("");

    const getTours = async () => {
        let response = await axios.get("/api/tour");
        tours.value = response.data.data;
    };

    const getTour = async (id) => {
        let response = await axios.get("/api/tour/" + id);
        tour.value = response.data.data;
    };

    const storeTour = async (data) => {
        errors.value = "";
        try {
            await axios.post("/api/tour", data);
            await router.push({ name: "tours" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const updateTour = async (id) => {
        errors.value = "";
        try {
            await axios.put("/api/tour/" + id, tour.value);
            await router.push({ name: "tours" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const destroyTour = async (id) => {
        await axios.delete("/api/tour/" + id);
    };

    const destroyTourDate = async (id) => {
        await axios.delete("/api/tour/date/" + id);
    };

    return {
        tours,
        tour,
        errors,
        getTours,
        getTour,
        storeTour,
        updateTour,
        destroyTour,
        destroyTourDate,
    };
}
