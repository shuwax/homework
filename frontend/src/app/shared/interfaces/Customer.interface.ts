export interface CustomerResponse {
    'data': Array<CustomerInterface>;
}

export interface CustomerInterface {
    id: number;
    name: string;
    rewardPointsOverall: number;
}
