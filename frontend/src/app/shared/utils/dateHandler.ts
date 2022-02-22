import moment from "moment";

export const convertTimeStampToDate = (date: string) => {
    return moment(date).format('YYYY-MM-DD')
}