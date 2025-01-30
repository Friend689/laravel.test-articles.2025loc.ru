export function useUtility() {
    const convertDateToHuman = (dateString) => {
        // Создаем объект Date из строки
        const date = new Date(dateString);

        // Получаем день, месяц и год
        const day = String(date.getDate()).padStart(2, "0"); // Добавляем ведущий ноль
        const month = String(date.getMonth() + 1).padStart(2, "0"); // Месяцы начинаются с 0
        const year = date.getFullYear();

        // Форматируем дату в нужный формат
        const formattedDate = `${day}.${month}.${year}`;
        return formattedDate;
    };

    const cutContentText = (origText, maxLength = 100) => {
        let text = origText;
        if (origText.length > maxLength) {
            text = text.substring(0, maxLength) + '...';
        }
        return text
    }

    return { convertDateToHuman, cutContentText };
}
