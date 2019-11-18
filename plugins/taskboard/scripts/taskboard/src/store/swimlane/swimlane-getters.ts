/*
 * Copyright (c) Enalean, 2019 - present. All Rights Reserved.
 *
 * This file is a part of Tuleap.
 *
 * Tuleap is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Tuleap is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tuleap. If not, see <http://www.gnu.org/licenses/>.
 */

import { SwimlaneState } from "./type";
import { Card, ColumnDefinition, Swimlane } from "../../type";
import { isStatusAcceptedByColumn } from "../../helpers/list-value-to-column-mapper";
import { getColumnOfCard } from "../../helpers/list-value-to-column-mapper";
import { RootState } from "../type";
import { findSwimlane } from "./swimlane-helpers";

export const cards_in_cell = (state: SwimlaneState, getters: [], root_state: RootState) => (
    current_swimlane: Swimlane,
    current_column: ColumnDefinition
): Card[] => {
    const swimlane_in_state = findSwimlane(state, current_swimlane);

    return swimlane_in_state.children_cards.filter((card: Card) => {
        const column_of_card = getColumnOfCard(root_state.column.columns, card);

        if (!column_of_card) {
            return false;
        }

        return column_of_card.id === current_column.id;
    });
};

export const has_at_least_one_card_in_edit_mode = (state: SwimlaneState): boolean => {
    return state.swimlanes.some(doesSwimlaneContainACardInEditMode);
};

export const is_loading_cards = (state: SwimlaneState): boolean => {
    return (
        state.is_loading_swimlanes ||
        state.swimlanes.some(swimlane => swimlane.is_loading_children_cards)
    );
};

export const nb_cards_in_column = (state: SwimlaneState) => (column: ColumnDefinition): number => {
    return state.swimlanes.reduce(
        (sum: number, swimlane) => nbCardsInColumnForSwimlane(swimlane, column) + sum,
        0
    );
};

function nbCardsInColumnForSwimlane(swimlane: Swimlane, column: ColumnDefinition): number {
    if (!swimlane.card.has_children) {
        return isStatusAcceptedByColumn(swimlane.card, column) ? 1 : 0;
    }

    return swimlane.children_cards.reduce((sum: number, card: Card) => {
        if (!isStatusAcceptedByColumn(card, column)) {
            return sum;
        }

        return sum + 1;
    }, 0);
}

function doesSwimlaneContainACardInEditMode(swimlane: Swimlane): boolean {
    return isCardInEditMode(swimlane.card) || swimlane.children_cards.some(isCardInEditMode);
}

function isCardInEditMode(card: Card): boolean {
    if (card.is_in_edit_mode) {
        return true;
    }

    if (!card.remaining_effort) {
        return false;
    }

    return card.remaining_effort.is_in_edit_mode;
}

export const does_cell_reject_drop = (state: SwimlaneState) => (
    swimlane: Swimlane,
    column: ColumnDefinition
): boolean => {
    if (!state.last_hovered_drop_zone) {
        return false;
    }

    return (
        state.last_hovered_drop_zone.is_drop_rejected === true &&
        state.last_hovered_drop_zone.column_id === column.id &&
        state.last_hovered_drop_zone.swimlane_id === swimlane.card.id
    );
};
