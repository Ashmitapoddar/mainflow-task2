

function show(formid){
    document.querySelectorAll(".box").forEach(form => form.classList.remove("active"));
    document.getElementById(formid).classList.add("active");
}