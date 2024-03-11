document.getElementById("updateButton").onclick = function () {
    document.getElementById("update").click();
};

document.getElementById("deleteButton").onclick = function () {
    if (confirm("Ви впевнені, що хочете видалити цей запис?")) {
        document.getElementById("delete").click();
    }
};

document.getElementById("eventDone").onclick = function () {
    document.getElementById("done").click();
};
