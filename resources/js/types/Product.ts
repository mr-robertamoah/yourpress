import Image from "./Image";

export default interface Product {
    name: string;
    type: string;
    size: string;
    description: string;
    uses: string[];
    images: Image[];
}
