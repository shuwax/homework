import moment from "moment";

export const convertTimeStampToDate = (date: number) => {
    return moment.unix(date).format('YYYY-MM-DD')
}

export const getCurrentDate = () => {
    return moment().format('YYYY-MM-DD')
}

export const getFormatDate = (date: string) => {
    return moment(date).format('YYYY-MM-DD')
}