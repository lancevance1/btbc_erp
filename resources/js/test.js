//
// let str = 'aaa';
// function clickValue(str) {
//
//
//     console.log(str)
//    this.str = str;
// }
//
// function getStr() {
//
//
//
//     return this.str;
// }

$(function () {
    $('.check').on('click', function () {
        $('.questionCheckBox').prop('checked',true);
    });
});

$(function () {
    $('.uncheck').on('click', function () {
        $('.questionCheckBox').prop('checked',false);
    });
});
