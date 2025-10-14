/**
 * Registers an Alpine.js component that manages a category <select>
 * for two types of categories (e.g., "expense" and "income").
 *
 * Props:
 * - type:       Currently active type ("expense" | "income").
 * - categoryId: Initially selected category ID (number|string|undefined).
 * - categories: List of categories. Array of { id, type, ... } objects to populate the select.
 *
 * Behavior:
 * - Filters categories by the active type.
 * - Remembers the last chosen category per type and restores it when the type changes.
 * - Ensures the selected category always belongs to the active type.
 *
 * @returns {Object} Alpine.js component state and methods.
 */
export default function dynamicSelect({ type, parentId, parents }) {

    return {
        // External props (initial values for the selects).
        type,
        parent_id: parentId ? String(parentId) : '',
        parents,

        // Returns the categories that match the current type.
        filteredParents() {
            return this.parents.filter(p => p.type === this.type);
        },

        // Checks whether the given category ID exists within the current type.
        parentHasCurrentType(parId) {
            const idStr = String(parId);

            return this.filteredParents().some(p => String(p.id) === idStr);
        },

        // Cache of the last selected options for each category type.
        selectedByType: {
            expense: '',
            income: ''
        },

        init() {
            // Remembers the last selected category for each type.
            this.selectedByType[this.type] = this.parent_id || '';

            // When the type changes, try to restore the last selection for that type.
            this.$watch('type', (val) => {
                const candidate = this.selectedByType[val] || '';

                // Only apply the candidate if it belongs to the newly active type.
                this.parent_id = this.parentHasCurrentType(candidate) ? candidate : '';
            })

            this.$watch('parent_id', (val) => {
                // Only cache it if it exists within the current type’s list.
                this.selectedByType[this.type] = this.parentHasCurrentType(val) ? val : '';
            })
        }
    }

}
