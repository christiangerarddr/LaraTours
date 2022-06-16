import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useCompany() {
    const companies = ref([]);
    const company = ref([]);
    const router = useRouter();
    const errors = ref("");

    const getCompanies = async () => {
        let response = await axios.get("/api/company");
        companies.value = response.data.data;
    };

    const getCompany = async (id) => {
        let response = await axios.get("/api/company/" + id);
        company.value = response.data.data;
    };

    const storeCompany = async (data) => {
        errors.value = "";
        try {
            await axios.post("/api/company", data);
            await router.push({ name: "company" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const updateCompany = async (id) => {
        errors.value = "";
        try {
            await axios.put("/api/company/" + id, company.value);
            await router.push({ name: "company" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const destroyCompany = async (id) => {
        await axios.delete("/api/company/" + id);
    };

    return {
        companies,
        company,
        errors,
        getCompanies,
        getCompany,
        storeCompany,
        updateCompany,
        destroyCompany,
    };
}
