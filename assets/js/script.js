let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
    sidebar.classList.toggle("active");
    if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    } else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}

/*
$(function() {

    $("#form").bind('submit', function(e) {
        var formData = {
            priority: $("#priority").val(),
            uId: $("#uId").val(),
            priode: $("#priode").val(),
        };
        var name = $("#priority").val();
        var priode = $("#priode").val();
        this.reset();
        $.post('../back_files/getData.php', formData, function(data) {

            $("#priorities-list").append('<div class="priority">\
                              <div>\
                                  <i class="bx bx-check"></i>\
                                  <span>' + name + '</span>\
                              </div>\
                              <div class="taskPriode">' + priode + '</div>\
                          </div>');
        });
        return false;
    });
    e.preventDefault();
});
*/
$(document).ready(function() {
    $("#project").load("../table.php");
    $("#member").load("../team.php");
    $('#calend').load("../calender.html");
    $('#statustic').load("../statistic.php");

    $("#priorities-list-over-due").hide();
    $("#priorities-list-complete").hide();
    $("#upcoming").click(function() {
        $("#priorities-list").show();
        $("#priorities-list-over-due").hide();
        $("#priorities-list-complete").hide();
    });
    $("#overdue").click(function() {
        $("#priorities-list").hide();
        $("#priorities-list-over-due").show();
        $("#priorities-list-complete").hide();
    });
    $("#complete").click(function() {
        $("#priorities-list").hide();
        $("#priorities-list-over-due").hide();
        $("#priorities-list-complete").show();
    });
});

// Add active class to the current button (highlight it)





$(document).ready(function() {

    $("#priorities-list-over-due").hide();
    $("#priorities-list-complete").hide();
    $("#upcoming").click(function() {
        $("#priorities-list").show();
        $("#priorities-list-over-due").hide();
        $("#priorities-list-complete").hide();
    });
    $("#overdue").click(function() {
        $("#priorities-list").hide();
        $("#priorities-list-over-due").show();
        $("#priorities-list-complete").hide();
    });
    $("#complete").click(function() {
        $("#priorities-list").hide();
        $("#priorities-list-over-due").hide();
        $("#priorities-list-complete").show();
    });
});


function empty() {
    var x;
    name = document.getElementById("priority").value;
    date = document.getElementById("priode").value;
    if ((date == "") || (name == "")) {
        alert("fill required fields");
        return false;
    };
}