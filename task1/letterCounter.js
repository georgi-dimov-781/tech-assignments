function countLetters(input) {
  const letterCount = {};

  for (let char of input) {
    if (/[a-zA-Z]/.test(char)) {
      letterCount[char] = (letterCount[char] || 0) + 1;
    }
  }

  const sorted = Object.keys(letterCount).sort().reduce((obj, key) => {
    obj[key] = letterCount[key];
    return obj;
  }, {});

  return JSON.stringify(sorted);
}

console.log(countLetters("Development"));
