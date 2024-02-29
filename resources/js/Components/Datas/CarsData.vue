<script>

export function reverseObject(obj) {
    const reversed = {};
    for (const [key, value] of Object.entries(obj)) {
        reversed[value] = key;
    }
    return reversed;
}

export const carTypesKo = {
    smallCar: "경차",
    compactCar: "소형차",
    midsizeCar: "중형차",
    fullsizeCar: "대형차",
    sportsCar: "스포츠",
};

export const carBrandsKo = {
    Hyundai: "현대",
    Kia: "기아",
    RenaultSamsung: "르노삼성",
    SsangYong: "쌍용",
    BMW: "BMW",
    MercedesBenz: "벤츠",
    Audi: "아우디",
    Ford: "포드",
    Chevrolet: "쉐보레",
    Tesla: "테슬라",
    Jaguar: "재규어",
};

</script>
