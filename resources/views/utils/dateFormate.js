export function getDateOnly(createdAt) {
    // Create a new Date object from the created_at string
    const date = new Date(createdAt);
    
    // Get the year, month, and day from the date object
    const year = date.getFullYear();
    const month = ('0' + (date.getMonth() + 1)).slice(-2); // Adding 1 because getMonth() returns 0-11
    const day = ('0' + date.getDate()).slice(-2);
    
    // Return the date in YYYY-MM-DD format
    return `${year}-${month}-${day}`;
}

// Example usage:
const createdAt = "2024-05-17T13:01:37";
const dateOnly = getDateOnly(createdAt);
console.log(dateOnly); // Outputs: 2024-05-17




