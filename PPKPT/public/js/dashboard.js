// Modal & Toggle Logic
const backdrop = document.getElementById("modal-backdrop");
let currentDeleteId = null;

function openModal(modalId) {
    document.getElementById(modalId).classList.remove("hidden");
    backdrop.classList.remove("hidden");
    document.body.style.overflow = "hidden";
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add("hidden");
    // Cek apakah masih ada modal terbuka
    const openModals = document.querySelectorAll('[role="dialog"]:not(.hidden)');
    if (openModals.length === 0) {
        backdrop.classList.add("hidden");
        document.body.style.overflow = "auto";
    }
}

// Add Modal
document.querySelectorAll(".btn-add").forEach((btn) => {
    btn.addEventListener("click", () => {
        const id = btn.dataset.modal;
        document.getElementById(id).classList.remove("hidden");
    });
});
// Function untuk Edit Modal
function openEditModal(id, status, catatan) {
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_status").value = status;
    document.getElementById("edit_catatan").value = catatan || "";
    document.getElementById("editModal").classList.remove("hidden");
    backdrop.classList.remove("hidden");
    document.body.style.overflow = "hidden";
}

function closeEditModal() {
    document.getElementById("editModal").classList.add("hidden");
    backdrop.classList.add("hidden");
    document.body.style.overflow = "auto";
}

// Function untuk Delete Modal
function openDeleteModal(id) {
    currentDeleteId = id;
    openModal("delete-modal");
}

function confirmDelete() {
    if (currentDeleteId) {
        // Redirect ke halaman delete
        window.location.href =
            "../../laporan/delete_laporan.php?id=" + currentDeleteId;
    }
    closeModal("delete-modal");
}

// Function untuk View Modal
function openViewModal(
    nama,
    nim,
    hp,
    email,
    kronologi,
    tkp,
    bukti,
    status,
    catatan,
) {
    document.getElementById("view-nama").innerText = nama || "-";
    document.getElementById("view-nim").innerText = nim || "-";
    document.getElementById("view-hp").innerText = hp || "-";
    document.getElementById("view-email").innerText = email || "-";
    document.getElementById("view-kronologi").innerText = kronologi || "-";
    document.getElementById("view-tkp").innerText = tkp || "-";
    document.getElementById("view-bukti").innerText = bukti || "-";
    document.getElementById("view-status").innerText = status || "-";
    document.getElementById("view-catatan").innerText = catatan || "-";

    // Set warna status
    const statusElement = document.getElementById("view-status");
    statusElement.className =
        "px-2 align-top inline-flex text-xs leading-5 font-semibold rounded-full";

    if (status === "Pending") {
        statusElement.classList.add(
            "bg-yellow-100",
            "text-yellow-800",
            "dark:bg-yellow-900/50",
            "dark:text-yellow-300",
        );
    } else if (status === "Diproses") {
        statusElement.classList.add(
            "bg-blue-100",
            "text-blue-800",
            "dark:bg-blue-900/50",
            "dark:text-blue-300",
        );
    } else if (status === "Selesai") {
        statusElement.classList.add(
            "bg-green-100",
            "text-green-800",
            "dark:bg-green-900/50",
            "dark:text-green-300",
        );
    }

    openModal("view-modal");
}

// Close when clicking backdrop
if (backdrop) {
    backdrop.addEventListener("click", () => {
        document.querySelectorAll('[role="dialog"]').forEach((el) => {
            el.classList.add("hidden");
        });
        backdrop.classList.add("hidden");
        document.body.style.overflow = "auto";
    });
}

// Theme Toggle Logic
var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");
var themeToggleBtn = document.getElementById("theme-toggle");

if (
    localStorage.theme === "dark" ||
    (!("theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    themeToggleLightIcon.classList.remove("hidden");
} else {
    themeToggleDarkIcon.classList.remove("hidden");
}

themeToggleBtn.addEventListener("click", function () {
    themeToggleDarkIcon.classList.toggle("hidden");
    themeToggleLightIcon.classList.toggle("hidden");

    if (localStorage.theme) {
        if (localStorage.theme === "light") {
            document.documentElement.classList.add("dark");
            localStorage.setItem("theme", "dark");
        } else {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("theme", "light");
        }
    } else {
        if (document.documentElement.classList.contains("dark")) {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("theme", "light");
        } else {
            document.documentElement.classList.add("dark");
            localStorage.setItem("theme", "dark");
        }
    }
});

// Mobile Sidebar Toggle
const sidebar = document.getElementById("sidebar");
const sidebarToggle = document.getElementById("sidebar-toggle");
let isSidebarOpen = false;

sidebarToggle.addEventListener("click", () => {
    // In mobile, transform controls visibility
    if (isSidebarOpen) {
        sidebar.classList.add("-translate-x-full");
    } else {
        sidebar.classList.remove("-translate-x-full");
    }
    isSidebarOpen = !isSidebarOpen;
});

// Tampilkan notifikasi jika ada parameter URL
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has("success")) {
        alert("Laporan berhasil ditambahkan!");
    } else if (urlParams.has("update")) {
        if (urlParams.get("update") === "success") {
            alert("Status laporan berhasil diperbarui!");
        } else if (urlParams.get("update") === "failed") {
            alert("Gagal memperbarui status laporan!");
        }
    } else if (urlParams.has("delete")) {
        if (urlParams.get("delete") === "success") {
            alert("Laporan berhasil dihapus!");
        }
    }

    // Hapus parameter dari URL
    if (urlParams.toString()) {
        window.history.replaceLocation(
            {},
            document.title,
            window.location.pathname,
        );
    }
});
