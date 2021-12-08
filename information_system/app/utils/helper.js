const capitalizeTheFirstLetterOfEachWord = (words) => {
    var separateWord = words.toLowerCase().split(' ');
    for (var i = 0; i < separateWord.length; i++) {
        separateWord[i] = separateWord[i].charAt(0).toUpperCase() +
            separateWord[i].substring(1);
    }
    return separateWord.join(' ');
}

const MONTH_IN_INDONESIA = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "July",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember"
];

const dateToIndonesiaDateFormat = (date) => {
    const day = date.split('-')[2];
    const month = date.split('-')[1];
    const year = date.split('-')[0];

    return `${day} ${MONTH_IN_INDONESIA[month-1]} ${year}`
}